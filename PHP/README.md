# PHP 코딩 스타일

[PSR-1/PSR-2](http://www.php-fig.org/)을 기본으로 하되 다음 규칙을 오버라이딩하여 따른다.



## 수정 PSR-1

- [4.2. Properties](http://www.php-fig.org/psr/psr-1/#42-properties)
  - `$snake_case`만 사용



## 수정 PSR-2

- [2.3. Lines](https://github.com/php-fig/fig-standards/blob/master/proposed/extended-coding-style-guide.md#23-lines)
  - line length는 soft limit(120 characters per line)을 따름
- [2.4. Indenting](https://github.com/php-fig/fig-standards/blob/master/proposed/extended-coding-style-guide.md#24-indenting)
  - 신규로 추가되는 프로젝트는 space(4) 사용
  - 레거시 코드는 tab(4) 사용




## 추가 규칙

### 네이밍

- 변수명은 $snake_case로 작성한다.
- private 함수나 변수명에 _(underscore) prefix는 붙이지 않는다.

### 타입 지정

- 새로 작성하는 파일은 declare(strict_types=1) 적용
- PHPDoc보다 PHP 7의 타입 힌팅 기능을 우선적으로 사용
  - PHP 7.1 미만 버전에서 Nullable 선언이 필요한 경우에만 PHPDoc을 활용
- 용도에 따른 null/false의 사용
  - false는 boolean 형식의 표현에만 사용
  - null은 "값이 없음"을 의미할 경우에만 사용
  - 초기 PHP 내장 함수의 false를 리턴하는 관례를 따르지 말 것
- 레퍼런스(&$var)의 사용
  - 참조 반환은 사용하지 않는다.
  - 참조에 의한 전달은 closure 변수 바인딩만 허용
    ```php
    $db->transactional(
      function () use (&$output) {
        $output = false;
      }
    );
    ```

### 내장 함수의 사용

- 빈 값을 체크하는 경우 empty() 함수 사용
  - 단, 변수의 값이 해당 변수 타입의 기본값과 같은 경우에는 empty()가 true를 리턴
  - 예) string "0", int 0 등은 empty() 결과가 true
  - 참고: empty, isset, is_null 함수의 [조건표](https://www.virendrachandak.com/techtalk/php-isset-vs-empty-vs-is_null/)
- 해당 변수가 set되었는지 확인하는 경우 isset() 함수 사용
  - 주로 $arr['data'] 나 $obj->data가 존재하는지 체크할 때 isset($arr['data']) / isset($obj->data) 사용
- compact() / extract() 사용금지
  - 선언되지 않은 변수를 참조할 경우 어떤 오류도 발생하지 않음
  - 변수를 암묵적으로 참조하므로 유지보수가 어려움


### 문자열

- ''과 ""의 사용
  - escape이 적게 사용되는 쪽을 사용
  - 예)
    - 'I will be back.' 
    - "I'll be back."
  - https://secure.php.net/language.types.string
- 템플릿 문자열에서 curly brace({"$var"})의 사용
  - IDE상에서 쉽게 식별이 가능하므로, 필요한 경우에만 괄호로 감쌀 것

### 비교문

- == / === 의 사용
  - 가능한 모든 경우에 ===를 사용, 그렇지 않을 경우에만 ==를 사용
- 삼항 연산자 사용
  - 연산자가 포함된 경우에는 반드시 괄호를 사용
    - `next_page = ($end_page === $total_pages) ? $end_page : ($end_page + 1);`
- 긴 조건문
  - &&, || 등은 가장 앞에 위치시킬 것
  - 조건문이 여러줄일 경우 닫는 괄호와 brace는 새로운 줄에 위치시킬 것
    ```php
    if (someCondition1 !== null
        && someCondition2 !== null
        && someCondition3 !== null
    ) {
        /* ... */
    }
    ```

### 배열

- 항상 short array 문법([])을 사용할 것




## 사용 PHP 버전

- 팀 외부에 공유되는 Composer 패키지는,
  - 최소 7.0 이상을 지원해야 함
  - 최신 안정화 버전까지 상위호환을 보장해야 함
- 언어의 최신 스펙(문법, 예약어, 리터럴)은 적극 활용
  - try ~ catch ~ finally, trait 등
  - Type Hinting은 최대한 활용




## 패키지 버저닝 및 릴리즈

- 외부에서 참조될 필요가 있는 코드는 언제나 [Composer](https://getcomposer.org/) 기반으로 관리
- 배포되는 버전은 반드시 명시적인 Git 태그를 사용하여 지정
  - 커밋 레퍼런스(`#commit-ref`)를 통한 버전 관리는 [Composer에서 사용하지 말 것을 권장](https://github.com/composer/composer/blob/1.5/doc/articles/troubleshooting.md#i-have-locked-a-dependency-to-a-specific-commit-but-get-unexpected-results)하고 있음
  - Composer의 [태그 명명 규칙](https://getcomposer.org/doc/articles/versions.md#tags)을 참고
- 버전 관리 정책은 [Semantic Versioning](http://semver.org/)을 따를 것
  - SemVer를 통해 이 패키지에 의존하는 사용자들에게 새로운 기능이나 버그 픽스, 또는 하위 호환 여부를 명확하게 전달 가능
- 하위호환 이슈가 발생할 경우 반드시 CHANGELOG에 기록을 남길 것
  - 내용과 형식은 [Doctrine2](https://github.com/doctrine/doctrine2/blob/master/UPGRADE.md) 프로젝트를 참고



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
  - File and Code Templates > Includes > File Header
    - PHP File Header 의 내용을 비울 것
  - General > Other
    - ✅ Ensure line feed at file end on Save
- Inspections (PHP)
  - Code Style 
    - ✅ Class path doesn't match project structure
  - Probable bugs
    - ✅ Assignment in condition
    - ✅ Division by zero




## PHP CodeSniffer 사용

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
  - 참고 : https://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm




## Proposed

- [Late Static Bindings](http://php.net/manual/kr/language.oop5.late-static-bindings.php) 사용 금지
  - `static::` 키워드 사용 금지
- return type declations 항상 작성 (플랫폼팀 규약)
  - [http://php.net/manual/kr/functions.returning-values.php#functions.returning-values.type-declaration](http://php.net/manual/kr/functions.returning-values.php#functions.returning-values.type-declaration)
  - null returnable 할 경우 phpdoc으로 작성(php7.1 에서는 지원예정)




## 참고 자료

- **[코딩 스타일 이외에 개발/보안/프로젝트 관리/배포 등과 관련된 지침서](http://www.phptherightway.com)**
- [Type Hinting in PhpStorm](https://blog.jetbrains.com/phpstorm/2016/07/php-7-support-in-phpstorm-2016-2/)
- [Modern PHP](http://www.slideshare.net/wan2land/modern-php-64855200)

