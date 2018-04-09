# JavaScript 코딩 스타일

## Style Guide

[Airbnb의 자바스크립트 스타일 가이드](https://github.com/airbnb/javascript/blob/master/README.md)를 기반으로 하되, 우리 상황에 맞게 일부 규칙을 오버라이딩하여 사용하고 있다.
변경된 규칙은 [이곳](https://github.com/ridi/eslint-config-ridibooks)에서 확인할 수 있다.


## ES2015+

권장되는 최소 자바스크립트 버전은 ES6(ECMAScript 2015)이다. 하위 호환이 필요한 경우에는 [Babel](https://babeljs.io/) 트랜스파일러를 통하여 지원하되, 가능한 최신(latest) 문법을 활용할 것. ES6에 대해 들어본 적이 없다면, [간략한 소개](https://babeljs.io/docs/learn-es2015/)와 [ES6 In Depth 시리즈](http://hacks.mozilla.or.kr/category/es6-in-depth/) 소개글을 읽어볼 것.


## Linting

정적 분석기로는 ESLint를 사용한다.
"왜 ESLint 인가?"에 대해서는 JSLint, JSHint(현재 grunt에서 사용), JSCS 와 [비교글](https://www.sitepoint.com/comparison-javascript-linting-tools/) 참고.

npm 을 사용한다면 [@ridi/eslint-config](https://www.npmjs.com/package/@ridi/eslint-config) 패키지를 통해 미리 설정된 규칙을 손쉽게 사용할 수 있다.


## WebStorm, PhpStorm 설정

Preference 메뉴에서 Editor > Code Style > Javascript 선택

* Tab and Indents 탭
  - Use Tab character 체크 해제
  - Indent 2


### ESLint 설정하기

Languages & Frameworks > Javascript > Code Quality Tools > ESLint 선택

* Enable 체크
* ESLint 패키지 위치 지정
* (선택) .eslintrc 위치 지정


## 패키지 관리 ([npm](https://www.npmjs.com))

- 패키지 이름(`package.json`의 `name` 필드)은 `ridi` 스코프를 사용한다. e.g. `"name": "@ridi/my-package"`.
- 패키지 버전(`package.json`의 `version` 필드)은 [Semantic Versioning](https://semver.org)을 따른다.
- 패키지 배포시 [npm](https://www.npmjs.com)을 이용한다.
  - 현재는 공개 배포만 가능하므로 `npm publish --access public` 명령으로 배포한다.
- 배포 권한이 없을 경우 [@ridi/performance](https://github.com/orgs/ridi/teams/performance)팀에 요청하여 [ridi Organization](https://www.npmjs.com/org/ridi)에 계정을 등록한다. 


## 참고

* [JavaScript Garden](http://bonsaiden.github.io/JavaScript-Garden/ko/) - JavaScript 언어의 핵심에 대한 내용이 있는 문서. 일독 권장
* [ESLint 활용하기](http://damian.dziaduch.pl/2015/11/25/eslint-install-and-config-phpstormwebstorm-and-git-pre-commit-hook/) - ESLint 설치 및 IDE, git hook 연동 가이드.
* [developers | npm Documentation](https://docs.npmjs.com/misc/developers) - npm을 이용한 개발 및 배포 가이드.
* [package.json | npm Documentation](https://docs.npmjs.com/files/package.json) - `package.json` 파일 스펙 문서.
