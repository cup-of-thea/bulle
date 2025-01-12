## 1.13.0 (2025-01-12)

### Feat

- **links**: add mastodon option
- **posts**: fix special chars in titles
- **authors**: add pronouns to authors profile
- **banner**: add banner a global setting
- **posts**: add status to posts
- **permanent**: add permanent authors
- **optimizations**: create new views to optimize relations
- wip
- **admin**: add posts admin
- **admin**: add author model
- **admin**: admin users

### Fix

- **responsive**: fix x-scroll on menus
- **posts**: add markdown renderer
- **posts**: do not allow to see un published posts
- **sqlite**: rewrite views for sqlite and mysqljk
- **sqlite**: allow to create views in sqlite
- **authors**: fix broken links
- **repository**: specify title column

### Refactor

- **clean**: use static analysis to clean code
- **pint**: ran pint to improve code quality
- **wipe**: clean unused classes
- **post**: remove references to old model

## 1.12.0 (2024-12-18)

### Feat

- **author**: change author name
- **editions**: last edition link
- add solene
- add authors content
- **authors**: get relations
- **authors**: get editions and categories by author
- **authors**: add author's page (#32)
- add editions pages (#25)
- **post**: add post page (#24)
- add tag page (#21)
- **categories**: display category page

### Fix

- **editions**: order editions descending
- **authors**: order authors by name
- **posts**: posts order by title inside categories
- **categories**: remove empty categories
- page magazine typo
- change email contact (#69)
- change email contact
- error
- add author images to lists
- lorem
- author icons
- footer icons
- **authors**: change default image on author page
- **authors**: default initial-based profile picture (#30)
- **meta**: add canonical  and meta data (#29)
- add favicon (#28)
- **editions**: add editions link to taxonomies nav (#26)

### Refactor

- rename queries (#18)
- introduce repositories and keep them away from the domain (#17)
- livewire components (#16)

## 1.4.3 (2024-03-04)

### Fix

- **build**: add npm dependencies and build
- **build**: remove typo error on CI

## 1.4.2 (2024-03-04)

## 1.4.1 (2024-03-04)

### Feat

- **authors**: add authors index page
- **tags**: add tags index page
- **categories**: add categories index page
- **banner**: announce opening
- **posts**: add last posts details
- **last-posts**: add description
- **last-posts**: introduce last posts query
- add association page with components
- **blog**: blog page
- add header and footer
- require thea/markdown-blog

### Fix

- align variables
