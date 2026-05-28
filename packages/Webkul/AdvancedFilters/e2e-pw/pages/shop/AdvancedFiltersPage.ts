import type { Page, Response } from "@playwright/test";
import { BasePage } from "../BasePage";

export class AdvancedFiltersPage extends BasePage {
    private readonly categoryIdsBySlug: Record<string, string> = {
        mens: "2",
    };

    constructor(page: Page) {
        super(page);
    }

    async gotoCategory(
        slug: string,
        categoryId?: string | number,
    ): Promise<void> {
        const normalizedSlug = slug.trim().toLowerCase();
        const resolvedCategoryId =
            categoryId?.toString() ?? this.categoryIdsBySlug[normalizedSlug];
        const query = resolvedCategoryId
            ? `?category=${resolvedCategoryId}`
            : "";

        await this.visit(`${normalizedSlug}${query}`);
    }

    async toggleFilterOption(
        filterId: string,
        optionId: string | number,
    ): Promise<void> {
        const labelSelector = `label[for="filter_${filterId}_option_${optionId}"]`;
        await this.page.locator(labelSelector).first().click();
    }

    async waitForFilteredProducts(params: Record<string, string>): Promise<Response> {
        return this.page.waitForResponse((response) => {
            if (! response.ok() || ! response.url().includes("/api/products")) {
                return false;
            }

            const url = new URL(response.url());

            return Object.entries(params).every(
                ([key, value]) => url.searchParams.get(key) === value,
            );
        });
    }

    async getProductCardsCount(): Promise<number> {
        return this.page.locator("div.action-items").count();
    }

    async setPriceRange(min: number, max: number): Promise<void> {
        const minSlider = this.page.locator('input[type="range"]').first();
        const maxSlider = this.page.locator('input[type="range"]').last();

        await minSlider.evaluate((el: HTMLInputElement, val) => {
            el.value = String(val);
            el.dispatchEvent(new Event("input"));
            el.dispatchEvent(new Event("change"));
        }, min);

        await maxSlider.evaluate((el: HTMLInputElement, val) => {
            el.value = String(val);
            el.dispatchEvent(new Event("input"));
            el.dispatchEvent(new Event("change"));
        }, max);
    }

    async getProductPrices(): Promise<number[]> {
        return this.page.$$eval("p.final-price", (elements) =>
            elements.map((el) => {
                const text = el.textContent?.replace(/[^0-9.]/g, "") || "0";
                return parseFloat(text);
            }),
        );
    }

    async getProductNames(): Promise<string[]> {
        return this.page.$$eval("p.break-all", (elements) =>
            elements.map((el) => el.textContent?.trim() || ""),
        );
    }

    async hasFilterSection(filterName: string): Promise<boolean> {
        const element = this.page.locator(`p:has-text("${filterName}")`);
        return (await element.count()) > 0;
    }
}
