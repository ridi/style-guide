# API 설계 원칙

API는 공개 수준에 따라 아래의 3가지로 구분하며, 가능한 높은 공개 수준을 지원해야 한다.

1. Public API

   - 서드파티 혹은 임의의 개인이 사용 가능
   - 스펙문서는 [Blueprint](https://github.com/apiaryio/api-blueprint/blob/master/API%20Blueprint%20Specification.md) 형식으로 작성하여 공개할 것
   - 하위 호환은 최소 6개월 이상 유지
   - 보안 프로토콜(https)을 사용해야 함
   - 인증에는 OAuth 2.0 을 사용해야 함
     

2. Protected API

   - 세컨드파티 혹은 내부 직원만 사용 가능
   - 스펙문서는 내부 관계자만 접근 가능
   - 하위호환은 최대 3개월까지 유지
     

3. Private API

   - 팀 내부에서만 사용 가능
   - 포맷, 문서화는 팀 내 규약에 따라 자유롭게 관리
   - 하위호환 유지할 필요 없음



#### Public/Protected API는,

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


## HTTP 상태 코드
다양한 response code를 사용하면 그 자체로 명시적이지만 코드 관리가 어려워진다는 단점이 있다.
따라서 아래 명시된 response code만을 사용하고 더 자세한 내용은 message-body에서 제공한다.

- [200](#200), [201](#201), [301](#301), [304](#304), [400](#400), [401](#401), [404](#404), [500](#500)

#### 다음 기준으로 결정

- 추가 동작이 필요할 수 있는 경우
- 브라우저, 검색엔진 최적화 여지가 있는 경우
- 단순 정보 제공의 의미만 가지는 경우는 최대한 배제

<a name="200"></a>
+ 200: OK
  - 성공적으로 처리.
  - 에러 응답에 대해서 사용하지 않도록 한다

<a name="201"></a>
+ 201: Created
  - 리소스 생성 완료.
  - 가능하면 응답에 리소스를 접근할 수 있는 URI를 포함시켜 필요한 경우 클라이언트에서 추가 요청을 보낼 수 있도록 한다.

<a name="301"></a>
+ 301: Moved Permanently
  - 요청한 리소스가 새로운 URI를 부여받았음
  - 새 URI를 응답 헤더 Location필드에 명시한다.

<a name="304"></a>
+ 304: Not Modified
  - 요청한 리소스가 변경되지 않음.
  - If-Modified-Since 요청 헤더를 이용하여 브라우저 캐시 사용을 유도하는데 사용한다.

<a name="400"></a>    
+ 400: Bad Request
  - 잘못된 요청.
  - 정의되지 않은 형식이나 부적절한 빈도, 모순된 상황 모두 포함하여 보내면 안되는 요청에 대한 응답.

<a name="401"></a>
+ 401: Unauthorized
  - 리소스 접근 권한이 없음.
  - 가능하면 응답에 인증에 관한 정보를 포함시켜 필요한 경우 클라이언트에서 추가 요청을 보낼 수 있도록 한다.

<a name="404"></a>
+ 404: Not Found
  - 매칭되는 URI가 없음.
  - 실제 리소스가 존재하더라도 존재 여부를 노출시키지 않고 싶은 경우 사용할 수도 있다.

<a name="500"></a>
+ 500: Internal Server Error
  - 서버 에러.
  - 요청은 정상적으로 받았지만 서버 처리 중 문제가 발생할 경우 전반에 사용한다.
    
#### 참고
  - [RFC 2616](https://www.w3.org/Protocols/rfc2616/rfc2616.html/)
  - [Choosing an HTTP Status Code — Stop Making It Hard](http://racksburg.com/choosing-an-http-status-code/)


