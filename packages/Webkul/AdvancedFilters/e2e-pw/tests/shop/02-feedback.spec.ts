import { test, expect } from "../../fixtures/test";
import { FeedbackPage } from "../../pages/shop/FeedbackPage";

test.describe("Shop — Customer Feedback Form", () => {
    test("should submit feedback successfully", async ({ page }) => {
        const feedbackPage = new FeedbackPage(page);

        await feedbackPage.gotoCategory("mens");
        await feedbackPage.clickYes();
        await feedbackPage.fillComment(
            "The filters helped me find products quickly.",
        );

        const feedbackResponse = feedbackPage.waitForFeedbackSubmission();
        await feedbackPage.submitFeedback();
        const response = await feedbackResponse;
        expect(response.status()).toBe(200);

        const body = await response.json();
        expect(body).toEqual({
            success: true,
            message: "advancedfilters::app.feedback.thank-you",
        });

        await feedbackPage.expectSuccessMessage();
    });
});
