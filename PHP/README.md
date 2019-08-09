# PHP 코딩 스타일

[PSR-1/PSR-2/PSR-12](http://www.php-fig.org/)를 기본으로 하되 아래의 규칙을 추가적으로 따른다.


## 추가 규칙

최소 지원 버전은 7.1이다.

### 네이밍

- 변수명은 `$snake_case`로 작성
  - 이는 [PSR-1 4.2. Properties](http://www.php-fig.org/psr/psr-1/#42-properties) 규칙을 보완한 것이다.
- private 함수나 변수명에 `_`(underscore) prefix는 붙이지 말 것

### 타입 지정

- 새로 작성하는 파일은 `declare(strict_types=1)` 적용
- PHPDoc보다 내장 타입 힌팅을 우선하여 사용
- 용도에 따른 `null`/`false`의 사용
  - `false`는 boolean 형식의 표현에만 사용
  - `null`은 "값이 없음"을 의미할 경우에만 사용
  - 초기 PHP 내장 함수의 `false`를 리턴하는 관례를 따르지 말 것
- 레퍼런스(`&$var`)의 사용
  - 참조 반환은 사용하지 말 것
  - 참조에 의한 전달은 closure 변수 바인딩만 허용
    ```php
    $db->transactional(
      function () use (&$output) {
        $output = false;
      }
    );
    ```

### 내장 함수의 사용

- 빈 값을 체크하는 경우 `empty()` 함수 사용
  - 참고: `empty`, `isset`, `is_null` 함수의 [조건표](https://www.virendrachandak.com/techtalk/php-isset-vs-empty-vs-is_null/)
- 참조하려는 대상이 명백히 초기화된 경우 `isset()` 함수 사용 금지
  - `isset`은 undefined와 `NULL`을 구분할 수 없기 때문
- `compact()` / `extract()` 사용 금지
  - 선언되지 않은 변수를 참조할 경우 어떤 오류도 발생하지 않음
  - 변수를 암묵적으로 참조하므로 유지보수가 어려움

### 문자열

- ''과 ""의 사용
  - escape이 적게 사용되는 쪽을 사용
  - 예)
    - `'I will be back.'`
    - `"I'll be back."`
  - https://secure.php.net/language.types.string
- 템플릿 문자열에서 curly brace(`{"$var"}`)의 사용
  - IDE상에서 쉽게 식별이 가능하므로, 필요한 경우에만 괄호로 감쌀 것

### 연산자

#### 비교 연산자
- `==` / `===` 의 사용
  - 가능한 모든 경우에 `===`를 사용, 그렇지 않을 경우에만 `==`를 사용
- 삼항 연산자 사용
  - 연산자가 포함된 경우에는 반드시 괄호를 사용
    - `next_page = ($end_page === $total_pages) ? $end_page : ($end_page + 1);`
- 긴 조건문
  - `&&`, `||` 등은 가장 앞에 위치시킬 것
  - 조건문이 여러줄일 경우 닫는 괄호와 brace는 새로운 줄에 위치시킬 것
    ```php
    if (someCondition1 !== null
        && someCondition2 !== null
        && someCondition3 !== null
    ) {
        /* ... */
    }
    ```

#### 에러 제어 연산자
- [Error Control Operator(`@`)](http://php.net/manual/en/language.operators.errorcontrol.php) 사용 금지

### 배열

- 항상 short array 문법(`[]`)을 사용할 것

### 클래스

- [Late Static Bindings](http://php.net/manual/kr/language.oop5.late-static-bindings.php) 사용 금지




## 의존성 관리 ([Composer](https://getcomposer.org/))

- 패키지 네임스페이스는 `ridibooks` 혹은 `ridi`여야 함
- 공개용 패키지는 [@ridi/performance](https://github.com/orgs/ridi/teams/performance) 팀에 요청하여 [Packagist](https://packagist.org/)에 등록
  - 등록된 패키지는 Auto Update 기능을 활성화하고 `ridi`를 메인테이너로 추가할 것
- 내부용 패키지는 [Satis](https://satis.ridi.io/)에서 관리 ([README](https://gitlab.ridi.io/common/satis/blob/master/README.md) 참고)
- 배포되는 버전은 반드시 명시적인 Git 태그를 사용하여 지정
  - 커밋 레퍼런스(`#commit-ref`)를 통한 버전 관리는 [Composer에서 사용하지 말 것을 권장](https://github.com/composer/composer/blob/1.5/doc/articles/troubleshooting.md#i-have-locked-a-dependency-to-a-specific-commit-but-get-unexpected-results)하고 있음
  - Composer의 [태그 명명 규칙](https://getcomposer.org/doc/articles/versions.md#tags)을 참고
- 버전 관리 정책은 [Semantic Versioning](http://semver.org/)을 따를 것
  - SemVer를 통해 이 패키지에 의존하는 사용자들에게 새로운 기능이나 버그 픽스, 또는 하위 호환 여부를 명확하게 전달 가능
  - 하위호환 이슈가 발생할 경우 반드시 `CHANGELOG`에 기록을 남길 것
  - 내용과 형식은 [Doctrine2](https://github.com/doctrine/doctrine2/blob/master/UPGRADE.md) 프로젝트 참고



## 프로젝트 디렉토리 구조

신규로 생성되는 프로젝트의 디렉토리는 [PHP The Right Way](https://phptherightway.com/#common_directory_structure)에서 [권장하는 구조](https://github.com/php-pds/skeleton)를 따른다.

- `twig` 템플릿은 `resources` 하위에 위치한다.
- 서빙을 위한 정적 파일은 `public` 하위에 위치한다.
- Other Directories에 `cron`, `docker` 등이 포함될 수 있다.



## PhpStorm 사용시

- PSR/PSR2 설정 : Preferences > Editor > Code Style > PHP > Set from… > PSR1/PSR2 선택
- Preferences > Editor
  - Code Style
    - Line separator (for new files): Unix and OS X (\n)
    - Right Margin (columns) : 120
  - Code Style > PHP > Wrapping and Braces > 'if()' statement
    - ✅ Place ')' on new line
  - Code Style > PHP > Code Conversion
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

- PhpStrom 설정법
  - Preferences > Languages & Frameworks > PHP > Code Sniffer
    Configuration 오른편 [...] 버튼을 누르고 PHP Code Sniffer path에 phpcs경로 설정
    (경로 확인은 brew info homebrew/php/php-code-sniffer)
  - Preferences > Editor > Inspections
    PHP - PHP Code Sniffer Validation 에 체크
    오른편 Coding standard 메뉴에서 Custom 선택 후 [...] 버튼을 누르고 ruleset.xml 선택
    (ruleset 위치 : Ridibooks-Web/docs/lint/php)
  - 참고 : https://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm




## 참고 자료

- **[코딩 스타일 이외에 개발/보안/프로젝트 관리/배포 등과 관련된 지침서](http://www.phptherightway.com)**
- [Guide to Building Secure PHP Software](https://paragonie.com/blog/2017/12/2018-guide-building-secure-php-software)
