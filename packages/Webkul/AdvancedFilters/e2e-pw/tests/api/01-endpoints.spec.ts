import { test, expect } from "@playwright/test";

test.describe("API — Advanced Filters Endpoints", () => {
    test("category-options returns active categories with pagination", async ({
        request,
    }) => {
        const response = await request.get("api/categories/category-options");
        expect(response.ok()).toBeTruthy();

        const body = await response.json();
        expect(body).toHaveProperty("data");
        expect(body).toHaveProperty("meta");
        expect(body.meta).toMatchObject({ current_page: 1, per_page: 20 });
    });

    test("attributes returns advanced filter metadata", async ({ request }) => {
        const response = await request.get("api/categories/attributes");
        expect(response.ok()).toBeTruthy();

        const filters = await response.json();
        expect(Array.isArray(filters.data)).toBeTruthy();
        expect(
            filters.data.some((filter: any) => filter.id === "category"),
        ).toBeTruthy();
    });

    test("feedback endpoint stores response and returns success", async ({
        request,
    }) => {
        const response = await request.post("api/categories/feedback", {
            data: {
                response: "yes",
                feedback: "Excellent filter tool",
                page_url: "categories/mens",
                category_id: "null",
            },
        });

        expect(response.ok()).toBeTruthy();
        const body = await response.json();
        expect(body).toMatchObject({ success: true });
    });
});
