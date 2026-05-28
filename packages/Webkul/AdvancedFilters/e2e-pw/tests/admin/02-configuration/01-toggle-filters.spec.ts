import { test } from "../../../fixtures/test";
import { AdvancedFiltersSettingsPage } from "../../../pages/admin/AdvancedFiltersSettingsPage";

test.describe("Admin — Advanced Filters Configuration", () => {
    test("should toggle filters settings and save successfully", async ({
        page,
    }) => {
        const settings = new AdvancedFiltersSettingsPage(page);

        await settings.open();
        await settings.setStatus(true);
        await settings.setFeedback(true);
        await settings.setStock(true);
        await settings.setPopular(true);
        await settings.saveAndVerify();
    });
});
