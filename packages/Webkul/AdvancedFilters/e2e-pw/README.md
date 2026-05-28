# `e2e-pw/` — Bagisto module Playwright suite

Standalone Playwright + TypeScript boilerplate for end-to-end testing a
Bagisto module against any running Bagisto install. Drop this folder into
a module repository (e.g. `packages/Webkul/<Module>/e2e-pw/`) and add
specs as the module grows.

The folder is self-contained — it has its own `package.json`,
`playwright.config.ts`, fixtures, and helpers. It can be moved anywhere
on disk and still run.

## Quick start

```bash
cp .env.example .env       # set BAGISTO_BASE_URL to your install
npm install
npm run install:browsers
npm test
```

The default suite ships with three seed specs that prove the install
is reachable end-to-end:

- `tests/admin/01-authentication/01-auth.setup.ts` — logs in once and
  saves storage state to `.state/admin-auth.json`.
- `tests/admin/02-dashboard/01-dashboard.spec.ts` — loads
  `/admin/dashboard` using the saved session.
- `tests/shop/homepage.spec.ts` — hits `BAGISTO_BASE_URL` and verifies
  the storefront is reachable.

Add module-specific specs alongside these seeds — don't replace them.

## Layout

```
e2e-pw/
├── data/                 # JSON test data + fixture images (mirrors Bagisto URL paths)
├── fixtures/
│   └── test.ts           # Custom test fixture; specs import { test, expect } from here
├── pages/
│   ├── BasePage.ts       # Abstract POM parent (visit, dataPath)
│   ├── admin/            # Page objects for /admin/... screens
│   └── shop/             # Page objects for storefront screens
├── tests/
│   ├── admin/            # Specs that drive /admin/... (one folder per resource)
│   └── shop/             # Specs that drive the storefront
├── utils/
│   ├── env.ts            # Single source of truth for process.env
│   ├── paths.ts          # E2E_ROOT_PATH, DATA_PATH, ADMIN_AUTH_STATE_PATH
│   └── bagistoVersion.ts # isBagistoVersionAtLeast() helper
├── .env.example
├── .prettierrc.json
├── playwright.config.ts
├── tsconfig.json
└── package.json
```

## Environment variables

| Variable                 | Purpose                                               | Default             |
| ------------------------ | ----------------------------------------------------- | ------------------- |
| `BAGISTO_BASE_URL`       | Storefront / admin host (required)                    | —                   |
| `BAGISTO_VERSION`        | Used by `isBagistoVersionAtLeast()` for branch gating | `2.4`               |
| `BAGISTO_ADMIN_EMAIL`    | Admin login email (used by your auth setup spec)      | `admin@example.com` |
| `BAGISTO_ADMIN_PASSWORD` | Admin login password                                  | `admin123`          |
| `ACTION_TIMEOUT`         | Default Playwright action timeout (ms)                | `10000`             |
| `NAVIGATION_TIMEOUT`     | Default Playwright navigation timeout (ms)            | `15000`             |
| `HEADED`                 | Run with a visible browser                            | `false`             |

All `process.env` reads happen in `utils/env.ts`. **Never** read
`process.env` from a spec, page object, fixture, or config.

## Conventions

1. **No comments anywhere.** Code must be self-explanatory — rename,
   extract, or restructure until it is. No `//`, `/* */`, JSDoc, or `#`
   in `.env*` files.
2. **Specs always import from `fixtures/test`**, never directly from
   `@playwright/test`. That keeps the env / page-init fixtures applied.
3. **Specs should not call `page.locator(...)` directly.** Selectors
   live inside page objects under `pages/`.
4. **Folder structure mirrors Bagisto URL paths.** A spec for
   `/admin/catalog/products` lives in `tests/admin/catalog/products/`,
   and its page objects live in `pages/admin/catalog/products/`.
5. **Sequential execution.** `playwright.config.ts` ships with
   `fullyParallel: false` and `workers: 1`. Tests are ordered
   alphabetically within a project — use numeric prefixes
   (`01-listing.spec.ts`, `02-create.spec.ts`, …) when order matters.
6. **`describe` breadcrumbs.** Use `Area — path › … › action`, e.g.
   `Admin — catalog › products › listing`. The numeric file prefix
   (`01-`, `02-`) is **not** part of the breadcrumb.
7. **Project pipeline.** The default config has three projects, run
   in this order:
    - `admin-setup` — runs `admin/**/*.setup.ts` to log in once and save
      `.state/admin-auth.json`.
    - `admin` — runs `admin/**/*.spec.ts` with the saved auth state.
      Depends on `admin-setup`.
    - `shop` — runs `shop/**/*.spec.ts` anonymously. Depends on
      `admin`, so admin specs always finish first — the storefront is
      tested after it's been set up by an admin.
8. **Single env source.** Anything from `process.env` goes through
   `utils/env.ts`. The host is `env.baseUrl`; literal URLs only appear
   in `.env.example`.

## Adding new specs

### A new shop spec

1. Add a page object under `pages/shop/<Screen>Page.ts` extending
   `BasePage`. Hide selectors inside it.
2. Add the spec at `tests/shop/<feature>.spec.ts`.
3. Import `{ test, expect }` from `../../fixtures/test`.

### A new admin spec

The admin auth setup (`tests/admin/01-authentication/01-auth.setup.ts`)
already ships with the boilerplate — login is performed once per
`npm test` run and the cookies + localStorage are saved to
`.state/admin-auth.json`. Every admin spec then runs with that storage
state preloaded.

1. Add the page object under `pages/admin/<area>/<Screen>Page.ts`.
2. Add the spec under `tests/admin/<area>/<NN>-<verb>.spec.ts`. The
   `admin` project depends on `admin-setup`, so the `page` fixture is
   already authenticated — navigate straight to the `/admin/...` URL
   you need.
3. Never `import` `AdminLoginPage` from a `*.spec.ts` file — that
   class exists only for the auth setup.

## Validation checklist before committing

```bash
npm run format        # Prettier auto-fix
npm run format:check  # Prettier CI-style check
npm run typecheck     # tsc --noEmit
npm test              # All specs
```

- Zero comments anywhere.
- No new top-level npm dependencies without approval.
- No imports reaching outside this `e2e-pw/` folder.
- No hardcoded URLs except in `.env.example`.
