# PHP 코딩 스타일

**[PSR1/PSR2](http://www.php-fig.org/)** 규칙을 기본으로 하되 다음 규칙을 오버라이딩하여 따른다.

- 수정된 규칙
  - 들여쓰기 : space(4) 대신 Tab 문자를 사용
  - line length는 soft limit(120 characters per line)을 따름
- 추가된 규칙
  - Line separator는 LF(Unix, \n)을 사용
  - 파일 끝에는 빈줄을 반드시 추가


## 버전
- PHP 버전은 **7.0**를 기준으로 한다.
    - PhpStorm > Preferences > PHP > PHP Language Level > 7.0 선택 > Apply
    - __하위 버전 호환은 고려하지 않는다.__
- 언어의 최신 스펙(문법, 예약어, 리터럴)은 적극 활용하도록 한다.
    - try ~ catch ~ finally, short array syntax, trait 등
    - Type Hinting 은 최대한 활용


## PhpStorm 사용시
- PSR/PSR2 설정 : Preferences > Editor > Code Style > PHP > Set from… > PSR1/PSR2 선택
- Preferences > Editor
  - Code Style
    - Line separator (for new files): Unix and OS X (\n)
    - Right Margin (columns) : 120
  - Code Style > PHP > Tabs and Indents
    - ✅ Use tab character
  - Code Style > PHP > Other
    - ✅ Force short declaration style
  - General > Other
    - ✅ Ensure line feed at file end on Save
    
## Inspections
- 오류와 경고를 최대한 해결하고, 커밋 전 Reformat Code 수행
- PHP CodeSniffer 사용
  - Mac에서 설치방법
  
    ```bash
    brew tap homebrew/homebrew-php
    brew install homebrew/php/php70
    brew install homebrew/php/php-code-sniffer
    ```
    
  - PhpStrom 설정법
    - Preferences > Languages & Frameworks > PHP > Code Sniffer
      Configuration 오른편 [...] 버튼을 누르고 PHP Code Sniffer path에 phpcs경로 설정
      (경로 확인은 brew info homebrew/php/php-code-sniffer)
    - Preferences > Editor > Inspections
      PHP - PHP Code Sniffer Validation 에 체크
      오른편 Coding standard 메뉴에서 Custom 선택 후 [...] 버튼을 누르고 ruleset.xml 선택
      (ruleset 위치 : Ridibooks-Web/docs/lint/php)
    - 참고 : https://www.jetbrains.com/phpstorm/help/using-php-code-sniffer-tool.html
 
- Preferences > Editor > Inspections
  - PHP
    - Code Style 
      - ✅ Class path doesn't match project structure
    - Probable bugs
      - ✅ Assignment in condition
      - ✅ Division by zero


## 코딩 스타일

- 타입 지정
 - PHP 7의 타입 힌팅 기능을 우선적으로 사용
 - Nullable 표현이 필요한 경우에는 PhpDocs 기능을 사용

- == / === 의 사용
 - 가능한 모든 경우에 ===를 사용, 그렇지 않을 경우에만 ==를 사용.
 - DBAL에서는 값이 없을때 (예 - fetchColumn 등) null이 아니라 false가 리턴됨에 주의

- 값을 체크하는 경우
  - 빈 값을 체크하는 경우 empty() 함수 사용
    - 단, 변수의 값이 해당 변수 타입의 기본값과 같은 경우에는 empty()가 true를 리턴한다.
    - 예) string "0", int 0 등은 empty() 결과가 true
    - empty, isset, is_null 함수의 조건표 참고 https://www.virendrachandak.com/techtalk/php-isset-vs-empty-vs-is_null/

  - 해당 변수가 set되었는지 확인하는 경우 isset() 함수 사용
    - 주로 $arr['data'] 나 $obj->data가 존재하는지 체크할 때 isset($arr['data']) / isset($obj->data) 사용
  - "값이 없음"을 나타낼 경우 null을 사용 (false는 사용하지 않음)
    - 초기 PHP 내장 함수는 false를 리턴하는 관례가 있으나 이는 잘못된 설계이므로 참고하지 말 것.

- 변수의 초기값
  - string : ''
  - int/float : 0
  - array : []
  - boolean : false
  - PHP 공식 문서 http://php.net/manual/kr/language.variables.basics.php

- 삼항 연산자 사용
  - +, === 등의 operator가 들어간 경우엔 괄호로 감싼다.
    - next_page = ($end_page === $total_pages) ? $end_page : ($end_page + 1);
  - 간결한 코드를 위해 $a ?: $b 형태를 쓸 수 있다. (단, PHP 5.3+ 에서만 사용 가능)
    - 원래 코드는 $a ? $a : $b
    - PHP 공식 문서 참고 http://php.net/manual/kr/language.operators.comparison.php#language.operators.comparison.ternary
 
- 네이밍
  - private 함수나 변수명에 _(underscore) prefix는 붙이지 않는다.
  - class member variable, local variable 은 다음과 같은 형식을 따름 $under_score

- 문자열 표현
  - '(따옴표)' 우선사용 "(쌍따옴표)"는 주의깊게 사용
    - 쌍따옴표 문자열은 문자열해석이 발생됨으로 의도와 다른 결과 나올 수 있으므로(\n \r \x20 $variable {$array[key]} 등)
  - https://secure.php.net/language.types.string
 
- 긴 조건문
  - &&, || 등은 가장 앞에 위치시킨다.
  - 조건문이 여러줄일 경우 닫는 괄호와 brace는 새로운 줄에 위치시킨다.
    ```php
    if (someCondition1 !== null
        && someCondition2 !== null
        && someCondition3 !== null
    ) {
        /* ... */
    }
    ```

- indexed array 에 array_unique 사용시 array_values 사용
  ```php
  var_dump(array_unique([1,2,2,2,3,3,3,3]));
  // array(3) { [0]=> int(1) [1]=> int(2) [4]=> int(3) }
  var_dump(array_values(array_unique([1,2,2,2,3,3,3,3])));
  // array(3) { [0]=> int(1) [1]=> int(2) [2]=> int(3) }
  var_dump(json_encode(array_unique([1,2,2,2,3,3,3,3])));
  // string(19) "{"0":1,"1":2,"4":3}"
  var_dump(json_encode(array_values(array_unique([1,2,2,2,3,3,3,3]))));
  // string(7) "[1,2,3]"
  ```


## Anti Patterns
- Yoda Condition
  - if ( null === $a ) 와 같은 식으로 비교 대상을 왼쪽에 몰아두는 패턴은 사용하지 않는다.
  - Yoda Condition은 Assignment in condition의 문제가 발생할 수 있어서 사용하지만, PHP Storm > Preference > Editor > Inspections > PHP > Probable Bugs > Assignment in condition을 통해 방지가 가능하다.
- Assignment in condition
  - if ( $post = getPost($id) ) 와 같이 조건문 내부에서 변수 값을 선언하는 패턴은 사용하지 않는다.
- [Late Static Bindings](http://php.net/manual/kr/language.oop5.late-static-bindings.php)
  - static:: 대신 self:: 사용
- compact() / extract() 사용금지
  - 선언되지 않은 변수를 참조할 경우 어떤 오류도 발생하지 않음
  - 변수를 암묵적으로 참조하므로 유지보수가 어려움
- 레퍼런스 변수 사용금지
  - 코드를 읽기 어렵게 만듦
  - 호출하는 쪽에서 매번 인자 타입을 보고 부작용이 없는지 체크하게 됨
  - 아직까지 레퍼런스를 쓰지 않아서 퍼포먼스 문제가 된 경우는 없음


## 기타 참고할 만한 문서
- **[코딩 스타일 이외에 개발/보안/프로젝트 관리/배포 등과 관련된 지침서](http://www.phptherightway.com)**
- [Type Hinting in PhpStorm](https://blog.jetbrains.com/phpstorm/2016/07/php-7-support-in-phpstorm-2016-2/)
- [Modern PHP](http://www.slideshare.net/wan2land/modern-php-64855200)
