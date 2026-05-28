# AGENTS.md — Cross-Agent Instructions for `e2e-pw/`

Scope: this file applies **only inside this `e2e-pw/` directory**. The
host module repository (and the wider Bagisto repository, if any) has
its own `AGENTS.md` — that one does not apply here.

## What this folder is

A standalone Playwright suite for a single Bagisto module. It runs
against a live Bagisto install pointed at via `BAGISTO_BASE_URL`. The
folder ships with three seed specs:

- `tests/admin/01-authentication/01-auth.setup.ts` — logs in once and
  saves storage state to `.state/admin-auth.json`.
- `tests/admin/02-dashboard/01-dashboard.spec.ts` — loads
  `/admin/dashboard` using the saved session.
- `tests/shop/homepage.spec.ts` — verifies the storefront is reachable.

The module owner adds module-specific specs alongside these seeds.

**The folder is intentionally self-contained** — it must remain
runnable after being copied anywhere on disk.

## Hard rules

1. **No comments. Ever.** This project bans comments in every file —
   `.ts`, `.env`, JSON, everything. No `//`, no `/* */`, no JSDoc, no
   `#` in `.env*` files. Code must be self-explanatory through clear
   naming, small functions, and intent-revealing structure. If a
   comment feels necessary, rename the variable, extract a helper, or
   split the function until the code reads on its own. When editing or
   adding a file, **strip every comment** before saving — even if you
   wrote them yourself moments ago.
2. **No paths reaching outside `e2e-pw/`.** Never
   `import`/`require` from `../`, never resolve files from the host
   module's source, never read `.env` files outside this folder. The
   folder must keep working after being moved anywhere on disk.
3. **No new top-level dependencies without approval.** `package.json`
   is intentionally minimal: `@playwright/test`, `@types/node`,
   `dotenv`, `prettier`, `typescript`. Adding anything else needs an
   explicit ask.
4. **Never read `process.env` outside `utils/env.ts`.** All
   configuration flows through the validated `env` object so there is
   exactly one place to add or rename variables.
5. **Never hardcode the domain.** The target host always comes from
   `BAGISTO_BASE_URL` via `env.baseUrl`. No string literals like
   `"http://bagisto.test"` anywhere except `.env.example`.
6. **Never commit `.env`.** Only `.env.example` is tracked. `.env` is
   gitignored — it carries per-developer host and credentials.
7. **Never delete or rewrite the seed specs without explicit
   approval.** These three files are the canaries that prove the
   install is reachable and the auth pipeline works:
    - `tests/admin/01-authentication/01-auth.setup.ts`
    - `tests/admin/02-dashboard/01-dashboard.spec.ts`
    - `tests/shop/homepage.spec.ts`

    The matching page objects (`pages/admin/LoginPage.ts`,
    `pages/admin/DashboardPage.ts`, `pages/shop/HomePage.ts`) are
    protected for the same reason. Add new specs alongside them, not
    in place of them.

8. **Keep `README.md`, `AGENTS.md`, and `CLAUDE.md` in sync.**
   Whenever the structure, scripts, env vars, or conventions change,
   update all three files in the same change.

## Repository map (`e2e-pw/`)

```
e2e-pw/
├── data/                       # JSON test data + fixture images, mirrors Bagisto URL paths
├── fixtures/
│   └── test.ts                 # Custom test fixture; specs always import from here
├── pages/
│   ├── BasePage.ts             # Abstract POM parent — visit(), dataPath()
│   ├── admin/
│   │   ├── LoginPage.ts        # Used only by 01-auth.setup.ts
│   │   └── DashboardPage.ts
│   └── shop/
│       └── HomePage.ts
├── tests/
│   ├── admin/
│   │   ├── 01-authentication/
│   │   │   └── 01-auth.setup.ts        # Logs in once, saves .state/admin-auth.json
│   │   └── 02-dashboard/
│   │       └── 01-dashboard.spec.ts    # Dashboard smoke test
│   └── shop/
│       └── homepage.spec.ts            # Storefront smoke test
├── utils/
│   ├── env.ts                  # Single source of truth for process.env
│   ├── paths.ts                # E2E_ROOT_PATH, DATA_PATH, ADMIN_AUTH_STATE_PATH
│   └── bagistoVersion.ts       # isBagistoVersionAtLeast() for branch gating
├── .env.example
├── .gitignore
├── .prettierrc.json
├── .prettierignore
├── playwright.config.ts
├── tsconfig.json
├── package.json
├── README.md
├── AGENTS.md
└── CLAUDE.md
```

## Environment variables

Defined in `utils/env.ts`. Every variable must also exist in
`.env.example`.

| Variable                 | Purpose                                               | Default             |
| ------------------------ | ----------------------------------------------------- | ------------------- |
| `BAGISTO_BASE_URL`       | Storefront / admin host (required)                    | —                   |
| `BAGISTO_VERSION`        | Used by `isBagistoVersionAtLeast()` for branch gating | `2.4`               |
| `BAGISTO_ADMIN_EMAIL`    | Admin login email                                     | `admin@example.com` |
| `BAGISTO_ADMIN_PASSWORD` | Admin login password                                  | `admin123`          |
| `ACTION_TIMEOUT`         | Default Playwright action timeout (ms)                | `10000`             |
| `NAVIGATION_TIMEOUT`     | Default Playwright navigation timeout (ms)            | `15000`             |
| `HEADED`                 | Run with a visible browser                            | `false`             |

## Architecture

### Layered design

```
tests/        ← What to verify (specs are declarative, data from JSON)
   ↓ uses
data/         ← Test data (JSON) + fixture images
   ↓ imported by
fixtures/     ← Shared setup/teardown (auth, env, page-init hooks)
   ↓ uses
pages/        ← How to interact with each screen (POM + image path resolution)
   ↓ uses
utils/        ← Pure helpers (env loader, paths, version check)
```

Specs should never call `page.locator(...)` directly — they call
methods on a page object that hides the selectors. This keeps specs
readable and makes selector changes a one-file fix.

### Project pipeline (`playwright.config.ts`)

| Project       | testMatch             | Dependencies  | Storage state            |
| ------------- | --------------------- | ------------- | ------------------------ |
| `admin-setup` | `admin/**/*.setup.ts` | —             | none                     |
| `admin`       | `admin/**/*.spec.ts`  | `admin-setup` | `.state/admin-auth.json` |
| `shop`        | `shop/**/*.spec.ts`   | `admin`       | none                     |

`shop` depends on `admin` so admin specs always run first — the
storefront tests follow the human-like flow (set up the store as an
admin, then browse it as a customer).

The boilerplate ships with all three projects populated:

- `admin-setup` runs `tests/admin/01-authentication/01-auth.setup.ts`,
  which logs in via `AdminLoginPage`, waits for the dashboard, and
  saves storage state to `ADMIN_AUTH_STATE_PATH` from `utils/paths.ts`
  using `ensureStateDir()`.
- `admin` runs every `admin/**/*.spec.ts` with the saved storage
  state. The seed spec is `tests/admin/02-dashboard/01-dashboard.spec.ts`,
  which proves the saved session lands on `/admin/dashboard`.
- `shop` runs `shop/**/*.spec.ts` anonymously. The seed spec is
  `tests/shop/homepage.spec.ts`.

Module-specific admin specs go under `tests/admin/<NN>-<area>/...`
and reuse the same auth setup — they should never log in themselves.

### Test area split (mandatory)

The suite is organised around two top-level areas:

- **`tests/admin/`** — drives `/admin/...`. Page objects live in
  `pages/admin/`.
- **`tests/shop/`** — exercises the storefront. Page objects live in
  `pages/shop/`.

Anything genuinely shared lives directly under `pages/` (e.g.
`BasePage.ts`).

### URL-mirroring sub-folders (mandatory)

Sub-folders mirror Bagisto URL paths:

| Bagisto URL prefix     | Tests path               | Page objects path        |
| ---------------------- | ------------------------ | ------------------------ |
| `/admin/settings/...`  | `tests/admin/settings/`  | `pages/admin/settings/`  |
| `/admin/catalog/...`   | `tests/admin/catalog/`   | `pages/admin/catalog/`   |
| `/admin/customers/...` | `tests/admin/customers/` | `pages/admin/customers/` |
| `/admin/sales/...`     | `tests/admin/sales/`     | `pages/admin/sales/`     |
| `/admin/marketing/...` | `tests/admin/marketing/` | `pages/admin/marketing/` |

### Entity folder structure (mandatory)

Every entity gets its own folder named after the lowercase plural URL
slug — e.g. `tests/admin/settings/channels/`. Spec files use a
two-digit numeric prefix and an action verb:

| Spec file            | URL                                  |
| -------------------- | ------------------------------------ |
| `01-listing.spec.ts` | `GET    /admin/.../<slug>`           |
| `02-create.spec.ts`  | `POST   /admin/.../<slug>/create`    |
| `03-edit.spec.ts`    | `PUT    /admin/.../<slug>/edit/{id}` |
| `04-delete.spec.ts`  | `DELETE /admin/.../<slug>/edit/{id}` |

Page objects are siblings of the tests folder under `pages/`. Naming:

| Resource         | Listing                 | Create                      | Edit / View               |
| ---------------- | ----------------------- | --------------------------- | ------------------------- |
| Channel          | `ChannelsPage`          | `ChannelCreatePage`         | `ChannelEditPage`         |
| Attribute        | `AttributesPage`        | `AttributeCreatePage`       | `AttributeEditPage`       |
| Attribute family | `AttributeFamiliesPage` | `AttributeFamilyCreatePage` | `AttributeFamilyEditPage` |
| Product          | `ProductsPage`          | `ProductCreatePage`         | `ProductEditPage`         |

Plural for listing, singular + action suffix for entity-specific.
Never plain singular like `ChannelPage` (ambiguous).

### Sequential execution (mandatory)

`playwright.config.ts` ships with `fullyParallel: false` and
`workers: 1`. Tests are ordered alphabetically within a project — use
numeric prefixes on file names (`01-listing.spec.ts`,
`02-create.spec.ts`, …) when order matters. **Do not rely on
`testMatch` array order** to control sequence; Playwright sorts
alphabetically.

## Conventions

### Imports

Specs always import from `fixtures/test`:

```ts
import { test, expect } from "../../fixtures/test";
```

Page objects import types from `@playwright/test` only:

```ts
import type { Page, Locator, Response } from "@playwright/test";
```

What you must never do inside a spec:

```ts
import { test, expect } from "@playwright/test";
```

### Page Object Model

- Each screen → one class in `pages/` extending `BasePage`.
- Methods are intent-revealing: `createChannel(data)`, not
  `clickChannelSubmitButton()`.
- Selectors live inside the page object, never in specs.
- Constructor takes a `Page` and passes it up: `super(page)`.
- `this.dataPath(relativePath)` resolves relative paths under `data/`
  to absolute paths — use it in upload methods so tests never see
  filesystem paths.

### Member ordering inside a page object class

| Order | Section                                                           |
| ----- | ----------------------------------------------------------------- |
| 1     | Constructor                                                       |
| 2     | Navigation                                                        |
| 3     | Locators by UI section (top-to-bottom matching the visual layout) |
| 4     | Page-level locators                                               |
| 5     | Public actions                                                    |
| 6     | Private helpers                                                   |

### Fixtures

- Add to `fixtures/test.ts` whenever multiple specs need the same
  setup.
- Each fixture is `async (deps, use) => { ... }` — set up, call
  `await use(value)`, then tear down after `use` returns.
- The boilerplate exports two fixtures: an `env` fixture wrapping the
  validated env, and an overridden `page` fixture that injects a
  global CSS rule hiding Bagisto's `.phpdebugbar` dev overlay (it
  intercepts clicks near the page footer on non-prod installs).

### Test data and images (mandatory)

Test data and fixture images are co-located under `data/` and mirror
the Bagisto URL path:

```
data/<resource-group>/<entity>/<id>/<meaningful-name>.json
```

with images alongside in an `images/` subfolder. JSON references
fixture images by **relative path from `data/`**, e.g.
`"logo": "settings/channels/1/images/logo.png"`. The page object
resolves to absolute paths via `this.dataPath(relativePath)`. Tests
never call `path.join` or know about filesystem layout.

### Naming

| Kind         | Convention                      | Example                            |
| ------------ | ------------------------------- | ---------------------------------- |
| Spec files   | `NN-kebab-case.spec.ts`         | `01-listing.spec.ts`               |
| Page objects | `PascalCase.ts`                 | `LoginPage.ts`, `DashboardPage.ts` |
| Utilities    | `camelCase.ts`                  | `randomSku.ts`                     |
| Test areas   | `tests/admin/` or `tests/shop/` | `tests/admin/channels.spec.ts`     |
| Page areas   | `pages/admin/` or `pages/shop/` | `pages/admin/ChannelsPage.ts`      |

`describe` blocks and `setup`/`test` names mirror the file path as a
breadcrumb using `" — "` (area separator) and `" › "` (depth
separator):

```
"Area — path › segment › ... › action"
```

The numeric file prefix (`01-`, `02-`) is **not** part of the
breadcrumb. Use the bare action verb only (`listing`, not
`01-listing`).

### TypeScript

- `strict`, `noUnusedLocals`, `noUnusedParameters` are on. Don't relax them.
- `npm run typecheck` is the source of truth for type validity — run
  it before claiming work is done.
- Avoid `any`; use `unknown` + narrowing if a type is genuinely
  unknown.

### Formatting (Prettier)

- Run `npm run format` before marking work complete.
- `npm run format:check` is the CI-style check that exits non-zero on
  drift.
- Do not add per-file or per-directory Prettier overrides without
  approval. The single config in `.prettierrc.json` applies to
  everything.

## Validation checklist (before marking work complete)

1. **Zero comments anywhere** in any file you touched. Grep for `//`,
   `/*`, and `#` in `.env*` and remove them all.
2. `npm run format` — Prettier auto-fixes any drift on touched files.
3. `npm run format:check` — succeeds with no diff.
4. `npm run typecheck` — no TS errors.
5. `npm test` — all tests pass against a real `BAGISTO_BASE_URL` (or
   document why skipped).
6. `README.md`, `AGENTS.md`, `CLAUDE.md` updated if behaviour or
   structure changed.
7. `.env.example` updated if env vars changed.
8. No new top-level npm dependencies in `package.json`.
9. No imports reaching outside `e2e-pw/`.
10. No `process.env` reads outside `utils/env.ts`.
11. No hardcoded URLs anywhere except `.env.example`.

## Documentation sync (mandatory)

`README.md`, `AGENTS.md`, and `CLAUDE.md` overlap on purpose so each
audience gets a complete view from one entry point. Whenever you
change:

- The directory layout
- `package.json` scripts or dependencies
- Environment variables (add / rename / change default)
- Conventions (imports, naming, comments, fixtures, page objects)
- The list of test areas or what the suite does
- Hard rules

…you **must** update all three files in the same change. When a
section is genuinely audience-specific (e.g. "Quick start for humans"
in `README.md` vs "Workflow expectations for Claude" in `CLAUDE.md`)
it can live in only one file — but anything factual about the suite
belongs in all three.
