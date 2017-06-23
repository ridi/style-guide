# RIDI Style Guide

### Language

- [HTML](HTML.md) - HTML, Twig/Jinja2 코딩 스타일
- [JavaScript](JavaScript)
- [Less](Less.md) - Less/CSS 코딩 스타일
- [MariaDB(MySQL)](MariaDB(MySQL).md) - DDL, DML 작성 규칙
- [PHP](PHP)
- [Python3](Python)


### Platform

- [Android](Android.md) - Kotlin, Java, XML 코딩 스타일
- [iOS](iOS.md) - [Swift](Swift), Objective-C 코딩 스타일
- [Qt](Qt.md) - C++, XML 코딩 스타일


### Etc

- [RESTful API](API.md) - RESTful API 작성 규칙
- [HTTP Status Code](HTTPStatusCode.md) - HTTP Status Code 규칙
- DDD(TBA)
- [UI 텍스트 작성 가이드](UItext.md)


<br>

## 규칙을 정하는 규칙

우리의 기조는 아래와 같다. (중요한 순서대로)

1. 코드의 작성자보다 리뷰어의 입장을 우선할 것
   - 불필요한 diff를 최소화 할 것
2. 기호의 충돌이 발생했을 때에는 간결한 쪽을 택할 것
   - 간결함이 동일할 때에는 일관성이 있는 쪽을 택할 것
   - 일관성이 동일할 때에는 대중성이 있는 쪽을 택할 것
3. 개발도구 중립성을 지킬 것


<br>

## 코드 리뷰 원칙

- 충분히 좋아야 올바르게 리뷰한 것
- 의견보다 사실을 주장할 것
- 사실에는 출처가 따르고, 의견에는 이유가 따를 것
- 코드 중복은 2번까지 허용
- 구체적일 것
- 필요하다면 "오프라인"으로 토론하되, 해결책은 기록을 남길 것
- 코딩스타일은 지적하지 않을 것
  - 이는 Linter(Fixer)가 할 일이다.
