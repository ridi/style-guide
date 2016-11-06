# Less 코딩 스타일

## 문법

문법 및 사용법은 [Less](http://lesscss.org/features/) 페이지 참고

## 스타일 가이드

- INDENT : space 2칸
- selector와 중괄호 사이에 space 1칸
- 속성은 가능하면 줄여서 사용
- 줄임 속성내 순서 및 요소들 반드시 지키기
  - ex)
  
    ```less
    { background: url(xxx.png) no-repeat; }          // (X)
    { background: url(xxx.png) left top no-repeat; } // (O)
    ```
    
- nesting 으로 인해 depth가 깊어질 경우 중괄호 닫아준 뒤 해당 클래스명을 주석으로 적어주는건 자율 (코딩 툴에서 지원하는 기능을 이용하며 최대한 클래스명 주석은 자제한다.)
- 파일명은 호출될 twig의  파일명을 따르며 앞에 'page_' 를 붙여준다.
- 모바일일 경우 .less 앞에 .m 추가 / ex) page_base.m.less
- 중괄호 뒤에서 개행해야 하는 경우는 다음과 같다.
  - 속성이 2개 이상일 경우
  - 속성이 1개만 있더라도 Mixin 호출일 경우
  - 콤마(,) 로 끊어서 한번에 부르는 셀렉터가 3개 이상일 경우 
