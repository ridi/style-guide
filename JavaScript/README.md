# JavaScript 코딩 스타일

## Style Guide

[Airbnb의 자바스크립트 스타일 가이드](https://github.com/airbnb/javascript/blob/master/README.md)를 기반으로 하되, 우리 상황에 맞게 일부 규칙을 오버라이딩하여 사용한다.

우리의 기조는 아래와 같다.

 1. 기호의 문제가 발생했을 때에는 짧고 간결한 것을 택할 것
 2. 1번이 동일할 때에는 일관성이 있는 쪽을 택할 것
 3. 2번이 동일할 때에는 대중송이 있는 쪽을 택할 것
 

## ES6

권장되는 자바스크립트 버전은 ES6(ECMAScript 2015)이며, 하위 호환이 필요한 경우에는 [Babel](https://babeljs.io/) 트랜스파일러를 통하여 지원한다. ES6에 대해 들어본 적이 없다면, [간략한 소개](https://babeljs.io/docs/learn-es2015/)와 [ES6 In Depth 시리즈](http://hacks.mozilla.or.kr/category/es6-in-depth/) 소개글을 읽어볼 것.


## ES6 Linting

정적 분석기로는 Airbnb preset을 제공하는 ESLint 를 사용한다.
"왜 ESLint 인가?" 에 대해서는 JSLint, JSHint(현재 grunt에서 사용), JSCS 와 [비교글](https://www.sitepoint.com/comparison-javascript-linting-tools/) 참고.
스타일 가이드에 해당하는 [.eslintrc](.eslintrc) 설정 파일을 참고할 것.


## WebStorm, PhpStorm 설정

Preference 메뉴에서 Editor > Code Style > Javascript 선택

* Tab and Indents 탭
  - Use Tab character 체크 해제
  - Tab size 2


### ESLint 설정하기

Languages & Frameworks > Javascript > Code Quality Tools > ESLint 선택

* Enable 체크
* ESLint 패키지 위치 지정
* (선택) .eslintrc 위치 지정


## 참고

* [JavaScript Garden](http://bonsaiden.github.io/JavaScript-Garden/ko/) - JavaScript 언어의 핵심에 대한 내용이 있는 문서. 일독 권장
* [ESLint 활용하기](http://damian.dziaduch.pl/2015/11/25/eslint-install-and-config-phpstormwebstorm-and-git-pre-commit-hook/) - ESLint 설치 및 IDE, git hook 연동 가이드
