# API 설계 원칙

API는 공개 수준에 따라 아래의 3가지로 구분하며, 가능한 높은 공개 수준을 지원해야 한다.

1. Public API

   - 서드파티 혹은 임의의 개인이 사용 가능
   - 스펙문서는 [Blueprint](https://github.com/apiaryio/api-blueprint/blob/master/API%20Blueprint%20Specification.md) 형식으로 작성하여 공개할 것
   - 하위 호환은 최소 6개월 이상 유지
   - 보안 프로토콜(https)을 사용해야 함
   - 인증에는 OAuth 2.0 을 사용해야 함
     

2. Internal API

   - 세컨드파티 혹은 내부 직원만 사용 가능
   - 스펙문서는 내부 관계자만 접근 가능
   - 하위호환은 최대 3개월까지 유지
     

3. Private API

   - 팀 내부에서만 사용 가능
   - 포맷, 문서화는 팀 내 규약에 따라 자유롭게 관리
   - 하위호환 유지할 필요 없음



#### Public/Internal API는,

- 반드시 HTTP 1.1 이상을 지원해야 한다.
- 반드시 REST 혹은 GraphQL 기반으로 작성되어야 한다.
   - RPC/HTTP는 사용될 수 없다.


<br>

## RESTful API 작성 가이드
([Zalando의 RESTful API Guidelines](http://zalando.github.io/restful-api-guidelines/)를 참고하여 작성되었음)

- 첫 번째 Path Segment 는 서비스명으로 시작한다.
   - 예) 검색 서비스: ```api.ridibooks.com/search/```
   - 예) 책 상세 서비스: ```api.ridibooks.com/books/```
 
- Path Segments 를 표현할 때에는 [kebab-case](https://en.wikipedia.org/wiki/Letter_case#Special_case_styles) 를 사용할 것
   - 예) ```/reading-notes/{b_id}```
   
- Query Parameters 에는 snake_case 를 사용할 것
 
- Trailing Slashes 를 사용하지 말 것
   - slash 를 사용한 경우와 사용하지 않은 경우 같은 결과를 반환해야 하고, / 를 붙이지 않는 것을 원칙으로 한다.
   
- Level 2 이상의 REST Maturity Model을 구현할 것
   - https://martinfowler.com/articles/richardsonMaturityModel.html#level2

- 요청과 응답에 사용되는 Payload는 JSON 형식을 따를 것
   - MIME 형식으로는 ```application/json```을 사용할 것
   - 프로퍼티 이름에는 snake_case 를 사용할 것
    
- 날짜와 시간 표기는 ISO 8601 표준을 따를 것
