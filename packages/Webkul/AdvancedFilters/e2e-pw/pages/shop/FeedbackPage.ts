import { expect, type Page, type Response } from "@playwright/test";
import { BasePage } from "../BasePage";

export class FeedbackPage extends BasePage {
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

    async clickYes(): Promise<void> {
        await this.page.locator('button:has-text("Yes")').click();
    }

    async clickNo(): Promise<void> {
        await this.page.locator('button:has-text("No")').click();
    }

    async fillComment(comment: string): Promise<void> {
        await this.page.locator("textarea").fill(comment);
    }

    async submitFeedback(): Promise<void> {
        await this.page.locator('button:has-text("Submit")').click();
    }

    async waitForFeedbackSubmission(): Promise<Response> {
        return this.page.waitForResponse((response) => {
            return (
                response.url().includes("/api/categories/feedback")
                && response.request().method() === "POST"
            );
        });
    }

    async expectSuccessMessage(): Promise<void> {
        const successText = this.page.getByText(
            "Thank you for your feedback!",
        );
        await expect(successText).toBeVisible();
    }
}
