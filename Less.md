# Less 코딩 스타일

## 문법

문법 및 사용법은 LESS 페이지 참고

## 스타일 가이드

- INDENT : space 2칸
- selector와 중괄호 사이에 space 1칸
- 속성은 가능하면 줄여서 사용
- 줄임 속성내 순서 및 요소들 반드시 지키기 / ex) background: url(xxx.png) no-repeat; (X)  background: url(xxx.png) left top no-repeat; (O) 
- nesting 으로 인해 depth가 깊어질 경우 중괄호 닫아준 뒤 해당 클래스명을 주석으로 적어주는건 자율 ( 코딩 툴에서 지원하는 기능을 이용하며 최대한 클래스명 주석은 자제한다. )
- 파일명은 호출될 twig의  파일명을 따르며 앞에 'page_' 를 붙여준다.
- 모바일일 경우 .less 앞에 .m 추가 / ex) page_base.m.less
- 중괄호 뒤에서 개행해야 하는 경우는 다음과 같다.
- 속성이 2개 이상일 경우
- 속성이 1개만 있더라도 Mixin 호출일 경우
- 콤마(,) 로 끊어서 한번에 부르는 셀렉터가 3개 이상일 경우 


## 컴파일

- less파일을 실시간 컴파일 하는 방식이 아니라 로컬에서 컴파일해서 CSS를 만들어서 해당 CSS를 배포한다.
- 컴파일은 Grunt less 를 사용하며 옵션은 해당 프로젝트의 Gruntfile.js를 참고

---

## 서점 less 구조

- 서점의 각 페이지들은 base.twig 을 extend 한다.
- 서점의 각 페이지들은 base.twig 에 정의되어있는 nanumgothic.css, page_base.css, vex...css 그리고 각각의 페이지에서 불러오는 page_xxx.css를 불러온다. 
- page_base.less
  - common/reset.less (style reset)
  - common/buttons.less (버튼 4종셋트)
  - ../icon/css/ridi-icon.less (아이콘폰트)
  - book_varsAndMixins.less (PC서점에서만 사용하는 mixin 과 var) - common/varsAndMixins.less (PC,M 공용 mixin 과 var)
  - page_login_signup_find_idpw.less (로그인, 회원가입, 아이디패스워드 찾기 페이지) - common/varsAndMixins.less (PC,M 공용 mixin 과 var)

- vex-theme-ridi-instant-slidedown.css - 서점에서 공용으로 사용하는 alert 창인 vex의 스타일 
- page_xxx.less
  - book_varsAndMixinx.less
  - book_compact.macro.less (단일 사이즈의 작은 썸네일과 최소한의 정보를 지닌 책 리스트 형 스타일 / 페이지에 해당 책목록이 있을 때에만 import)

### reset.less
- 서점용 기본 스타일 리셋
- .none, .clear_both 등 몇몇 class 가 지정 되어 있는데 추후 mixin 형태로 varsAndMixin.less 로 옮겨야함 (서점 외의 다른 페이지의 스타일에서 import 해서 사용중이여서 파악후 제거 필요)

### buttons.less
- 버튼 스타일 묶음으로 gradation 과 flat 스타일로 각각 4가지 색상의 버튼을 미리 정의해 놓았다. gradation 스타일은 페이지 리뉴얼시 모두 flat 스타일로 교체한다.
- gradation 스타일의 버튼은 button 혹은 a 엘리먼트에 .default_btn .btn_blue 이렇게 2개의 class 를 추가해 주면 된다.
- flat 스타일의 버튼은 button 혹은 a 엘리먼트에 .blue_button 이렇게 1개의 class 를 추가해 주면 된다.
- 즉, 현재 사용중인 class 는 .blue_button, .white_button, .gray_button, .facebook_button 이렇게 4종이다.

### ridi-icon.less
- 서점내의 모든 bullet 과 icon 들은 svg font로 만들어서 관리한다.
- 아이콘 폰트를 만들어주는 관리 프로그램은 예전 Chrome 브라우저의 확장 프로그램인 icomoon 을 사용하다가 grunt web-font로 변경(다중 작업자를 위한 프로세스 개선)

### varsAndMixins.less
- 공용으로 사용하는 다양한 mixin과 변수들이 정의되어 있다.
  vendor prefix 가 필요한 css 속성들을 주로 mixin 으로 묶어서 사용하고 paging 이나 line_clamp 도 mixin 으로 묶어서 사용한다.
- 다음의 파일들을 import 하고 있다.

| Import | Description |
|---|---|
| @import "colorChips";	| 서점 및 앱에서 사용하는 UX 팀과의 협의에 의해 만들어지는 컬러 변수들 묶음 |
| @import "base64Image";	| 굳이 파일로 갖고 있지 않아도 되는 자주 사용하는 이미지들을 base64로 변환해서 사용 |
| @import "fontMixins";	| 웹폰트를 mixin 형태로 미리 정의해놓았다. 특정 폰트를 사용해야 하는 경우 이 파일에 추가하고 해당 페이지 less 에서 mixin 호출해서 사용. 현재 베스트 셀러에서 사용한 순위용 폰트와 리뷰에서 사용하는 점수용 폰트가 정의되어 있다. |


### book_varsAndMixins.less
- 위 varsAndMixins.less 를 import 하며 PC 서점에서만 사용하는 mixin 들과 var 들을 추가한 less


## 웹폰트 추가 방법
1. 폰트파일 준비(ttf, woff, eot)
2. ttf, woff 는 base64로 변환, eot 파일은 fonts 폴더에 넣기
3. less/common/fontMixins.less 에 mixin 추가 - mixin 이름을 정하고, base64로 변환한 ttf, woff 및 eot 파일 경로를 추가
4. 사용할 페이지의 less 에서 해당 mixin을 정의하면 지정한 class에 폰트가 적용된다.

```less
// fontMixins.less
.font_xxx(){
    @font-face {
        font-family: 'xxx';
        src: url('fonts/xxx.eot'); // eot파일 경로
    }
    @font-face {
        font-family: 'xxx';
        src: url(data:application/x-font-ttf;charset=utf-8;base64,변환한 정보) format('truetype'),
        url(data:application/font-woff;charset=utf-8;base64,변환한 정보) format('woff');
        font-weight: normal;
        font-style: normal;
    }
}
 
// page_aaa.less
.font_target{
    .font_xxx();
}
```
