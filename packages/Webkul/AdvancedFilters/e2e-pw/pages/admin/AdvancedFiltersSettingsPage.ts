import { expect, type Page } from "@playwright/test";
import { BasePage } from "../BasePage";

export class AdvancedFiltersSettingsPage extends BasePage {
    constructor(page: Page) {
        super(page);
    }

    private get statusToggle() {
        return this.page.locator(
            'label[for="general[advancefilter][settings][status]"]',
        );
    }

    private get feedbackToggle() {
        return this.page.locator(
            'label[for="general[advancefilter][settings][show_feedback_form]"]',
        );
    }

    private get stockToggle() {
        return this.page.locator(
            'label[for="general[advancefilter][settings][show_out_of_stock]"]',
        );
    }

    private get popularToggle() {
        return this.page.locator(
            'label[for="general[advancefilter][settings][show_popular_products]"]',
        );
    }

    private get statusInput() {
        return this.page.locator(
            'input[name="general[advancefilter][settings][status]"][type="checkbox"]',
        );
    }

    private get feedbackInput() {
        return this.page.locator(
            'input[name="general[advancefilter][settings][show_feedback_form]"][type="checkbox"]',
        );
    }

    private get stockInput() {
        return this.page.locator(
            'input[name="general[advancefilter][settings][show_out_of_stock]"][type="checkbox"]',
        );
    }

    private get popularInput() {
        return this.page.locator(
            'input[name="general[advancefilter][settings][show_popular_products]"][type="checkbox"]',
        );
    }

    private get saveButton() {
        return this.page.locator(
            'button[type="submit"].primary-button:visible',
        );
    }

    private get successNotification() {
        return this.page.getByText("Configuration saved successfully");
    }

    async open(): Promise<void> {
        await this.visit("admin/configuration/general/advancefilter");
    }

    async setStatus(enable: boolean): Promise<void> {
        const isChecked = await this.statusInput.isChecked();
        if (enable !== isChecked) {
            await this.statusToggle.click();
        }
    }

    async setFeedback(enable: boolean): Promise<void> {
        const isChecked = await this.feedbackInput.isChecked();
        if (enable !== isChecked) {
            await this.feedbackToggle.click();
        }
    }

    async setStock(enable: boolean): Promise<void> {
        const isChecked = await this.stockInput.isChecked();
        if (enable !== isChecked) {
            await this.stockToggle.click();
        }
    }

    async setPopular(enable: boolean): Promise<void> {
        const isChecked = await this.popularInput.isChecked();
        if (enable !== isChecked) {
            await this.popularToggle.click();
        }
    }

    async saveAndVerify(): Promise<void> {
        await this.saveButton.click();
        await expect(this.successNotification).toBeVisible();
    }
}
