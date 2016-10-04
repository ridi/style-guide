# HTML / Twig / Jinja2 가이드

## 웹표준과 웹접근성

- 웹표준을 철저하게 지킨다.
- 브라우저는 IE9+, Chrome, Safari, Firefox 지원
- 마크업시 문서의 흐름을 생각하며 마크업 ( CSS가 없어도 문서로 읽힐 수 있도록 마크업 )
- twig의 html으로 먼저 구조를 잡고난 뒤에 스타일시트를 이용하여 디자인을 맞추는 순서로 퍼블리싱을 진행하도록 한다.


## HTML5

- font, center 등 html5에서 없어진 tag들은 사용하지 않는다.
- style 과 script tag에  Type을 지정하지 않는다.
- 페이지에 제목으로 명시될만한 요소가 없는 경우 **class="hidden"** 으로 페이지 타이틀을 명시해준다.
- 기존에 DOM 구조의 depth가 깊어질 경우 사용하고 있는 Text Editor나 Compiler 의 기능을 이용한다. **(태그가 끝나는 부분에 불필요한 주석을 달지 않도록 한다)** 
- style 을 HTML tag에 inline으로 넣지 않는다.
- 각종 Path는 ” 로 묶어준다.
- image text를 최소화 하기 위해 **24px 이상의 폰트를 사용해야 하는 경우에만 background-image 방법을 사용**
- div, span, article 등으로 끝나고 바로 뒤에 hr 태그가 붙으면 div, span의 닫는 태그와 붙여서 써준다. 단, 여는 태그와 닫는태그가 한 줄에 있을경우는 예외.

~~~ html
<div>
    "Content"
</div><hr>
 
{# 예외상황 #}
<div></div>
<hr>
~~~

- attribute 의 네이밍 에는 언더바( _ ) 가 아닌 하이픈 ( - ) 으로 공백 구분하여 네이밍 한다.
  -  data-sample_attribute ( x )
  -  data-sample-attribute ( o )


## Twig / Jinja2

#### html 부분의 컨벤션은 위의 HTML5  컨벤션을 기본적으로 따르도록 한다.

- 기본적으로 BASE_TEMPLATE 를 extends 하여 사용한다.
- 스타일시트는 {% block style %} 내부에, 스크립트는 {% block script %} 내부에, html 내용이 들어갈 컨텐츠는 {% block content %} 내부에 선언한다.
- 기존에는 html 의 주석인 <!-- --> 과 템플릿엔진의 주석인 {# #} 이 혼용되어 사용되고 있었으나, script 영역을 제외하고는 템플릿엔진의 주석을 이용하여 작성한다.
- 조건적으로 붙게 되는 클래스를 {% if 조건 %}클래스{% endif %} 로 붙이는 경우 공백은 기본적으로 조건문 내부에 넣어서 해당하지 않을경우 불필요한 공백이 끼어들지 않도록 한다.
  - 예외: 조건 두가지이상 의 경우에 무조건 한가지 이상이 들어가게 되는 경우는 공백을 기본적으로 외부에 넣어주도록 한다.) 

### BASE_TEMPLATE 을 extends 하여 사용할 시에 기본적인 구조

meta, style, script 블럭을 선언 하여 사용할시에 기본 base 트윅에서 해당 블럭을 상속받으려는 경우
{{ parent() }} 를 선언 해준다.

~~~
{% block meta %}
  // 메타 태그 영역
{% endblock %}
 
{% block style %} 
 // 스타일시트 영역
{% endblock %}
  
{% block script %}
 // 스크립트 영역
{% endblock %}
  
{% block header_bottom %}
 // 헤더의 가장 마지막 줄인 base.gnb 가 들어갈 영역 ( 상황에 따라 쓰이는 경우와 안쓰이는 경우가 있어 블럭 처리 )
{% endblock %}
  
{% block contents %}
 // 본 내용이 들어갈 공간
{% endblock %}

{% block bottomscript %}
 // body 내부에서 가장 최하단에 들어갈 스크립트 영역 ( 리액트 등에서 사용 )
{% endblock bottomscript %}
~~~

### if 를 사용할때 조건이 길어져서 줄바꿈을 하는 경우에는 or, and 등의 비교 연산자를 줄의 가장 앞에 오도록 선언한다.

예시) 
~~~
{% if example_a == 1
      or example_b == 2
      and example_c == 3 %}
// code

{% endif %}
~~~


### 줄바꿈과 들여쓰기

- Indent : space 2칸  //  Continuation Indent : space 4칸
- block요소들 그리고 CSS의 display가 block 또는 inline-block 으로 지정된 inline 요소 들은 줄바꿈과 들여쓰기를 한다.
- header, footer, section, article, nav, aside, div, form, field 등 내용이 그룹화 되는 tag 뒤에는 새로운 빈줄을 추가한다.
- twig 내의 오브젝트 객체를 set 해주는 경우 아래의 컨벤션을 따른다.
~~~
{# 프로퍼티가 여러개일 경우 #}
{% set options = {
    'key_name': key_value,
    'key_name': key_value,
    'key_name': key_value
} %} 
 
{# 단일 프로퍼티일 경우 #}
{% set options = {'key_name': key_value} %}
~~~


## Tag 주의사항

| div, span | 절대적으로 최소화 해서 사용. -> div 와 span을 남용할 경우 소스의 가독성이 떨어지고 depth가 깊어져 사이트의 성능저하를 일으킨다. |
| table     | thead, tfoot, tbody 구분을 명확히 해야하며 th 와 td 또한 구분해서 사용해야 한다. caption 또한 가능하면 반드시 넣어준다. |
| button, a | 둘을 명확히 구분해서 사용해야 한다. 별다른 동작이 필요없이 link 역할을 할때에는 a 를, JS와의 연동 혹은 submit 역할을 할때에는 button 을 사용한다. button을 사용할 시에 특정 type 이 지정되지 않을 경우에 type="button" 을 항상 명시해준다. | 
| img       | alt 를 반드시 넣어준다. |
| form요소	| 디자인을 위한 Custom UI 를 구현할 때에도 반드시 form 요소들을 사용해야한다. |
| nav       | 사이트 최상위 메뉴(GNB 영역)에 한번만 사용한다. |


## Class, ID 네이밍 규칙

- 스타일 적용을 위한 class와 ID 는 모두 소문자와 under_score 를 조합하여 만든다.
- JavaScript용 class name은 앞에 'js_'를 붙여 style용 class name과 구분한다.
   (태그가 변경되거나 불필요한 스타일용 클래스가 제거 되어도 기능에 영향을 최대한 적게 주기 위한 방안)
~~~
.js_series_list (O)
~~~
    
- naming은 내용을 기준으로 지정하여 style 과 분리시킨다.
~~~
.blue_box, .orange_text             (X)
.header_title, .subcategory_info    (O)
~~~

- 네이밍은 재사용성을 위해 최대한 일반화한다.
~~~
.warning_text_point_consume     (X)
.warning_text                   (O)
~~~

- 요소를 감싸고 있는 DOM과 실제 역할을 하는 요소들의 네이밍 통일성을 최대한 맞춰준다.
~~~
<ul class="element_item_wrapper">
   <li class="element_item"></li>
   <li class="element_item"></li>
</ul>
~~~


## 참고

- [W3C HTML5](https://www.w3.org/TR/html5/)
- [HTML Validator](http://validator.kldp.org/)
- [CSS Validator](http://www.css-validator.org/)
- [Google HTML Style Guide](https://google.github.io/styleguide/htmlcssguide.xml)
