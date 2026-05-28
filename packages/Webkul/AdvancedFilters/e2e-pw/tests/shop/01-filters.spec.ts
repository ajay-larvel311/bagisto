import { test, expect } from "../../fixtures/test";
import { AdvancedFiltersPage } from "../../pages/shop/AdvancedFiltersPage";

test.describe("Shop — Advanced Filters", () => {
    test("should render filter sections and allow filtering products", async ({
        page,
    }) => {
        const filtersPage = new AdvancedFiltersPage(page);

        await filtersPage.gotoCategory("Mens");

        const hasCategoryFilter =
            await filtersPage.hasFilterSection("Customer Ratings");
        expect(hasCategoryFilter).toBeTruthy();

        const ratingsResponse = filtersPage.waitForFilteredProducts({
            ratings: "2",
        });
        await filtersPage.toggleFilterOption("ratings", 2);
        await ratingsResponse;

        const offersResponse = filtersPage.waitForFilteredProducts({
            ratings: "2",
            offers: "on_sale",
        });
        await filtersPage.toggleFilterOption("offers", "on_sale");

        const filteredProductsResponse = await offersResponse;
        const filteredProducts = (await filteredProductsResponse.json()).data;

        await expect(page).toHaveURL(/ratings=2/);
        await expect(page).toHaveURL(/offers=on_sale/);

        expect(Array.isArray(filteredProducts)).toBeTruthy();

        if (filteredProducts.length > 0) {
            expect(await filtersPage.getProductCardsCount()).toBeGreaterThan(0);

            for (const product of filteredProducts) {
                expect(product.on_sale).toBeTruthy();
            }
        } else {
            await expect(
                page.getByRole("heading", {
                    name: "No products available in this category",
                }),
            ).toBeVisible();
        }
    });
});
