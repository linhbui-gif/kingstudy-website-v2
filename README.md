This is a [Next.js](https://nextjs.org/) project bootstrapped with [`create-next-app`](https://github.com/vercel/next.js/tree/canary/packages/create-next-app).

## Getting Started

First, run the development server:

```bash
npm run dev
# or
yarn dev
# or
pnpm dev
# or
bun dev
```

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

## Step Setup husky commit convention
```bash
npm install --save-dev @commitlint/{config-conventional,cli}

npx husky add .husky/commit-msg // Tạo File commit-msg 

Mở file commit-msg điền nội dung sau 

#!/bin/sh
. "$(dirname "$0")/_/husky.sh"
yarn lint
yarn build:prod
npx --no-install commitlint --edit "$1" --config ./commitlint.config.js

Tạo file commitlint.config.js

Thiết lập rule 

module.exports = {
  extends: ['@commitlint/config-conventional'],
  rules: {
    'body-max-line-length': [1, 'always', 72], // Giới hạn chiều dài của body
    'header-max-length': [2, 'always', 50], // Giới hạn chiều dài của header
    'subject-case': [2, 'always', 'sentence-case'], // Subject phải viết hoa chữ cái đầu tiên
    'type-enum': [2, 'always', ['feat', 'fix', 'docs', 'style', 'refactor', 'test', 'chore']] // Loại commit phải thuộc danh sách nhất định
  }
};
```