# HTTP API 설계 원칙

API는 공개 수준에 따라 아래의 3가지로 구분하며, 가능한 높은 공개 수준을 지원해야 한다.

1. Public API

   - 서드파티 혹은 임의의 개인이 사용 가능
   - FQDN: `api.ridibooks.com`
   - 하위 호환은 최소 6개월 이상 유지
   - 보안 프로토콜(TLS/SSL)을 사용해야 함 외부에 공개
   - 인증에는 OAuth 2.0을 사용해야 함

2. Protected API

   - 세컨드파티 혹은 내부 직원만 사용 가능
   - FQDN:
     - 공인 IP가 있다면 `{team}-api.ridibooks.com`
     - 공인 IP가 없다면 `api.{team}.ridi.io`
   - 공인 IP를 가질 경우 보안 프로토콜(TLS/SSL)을 사용해야 함
   - 하위호환은 최대 3개월까지 유지
   - 클라이언트 라이브러리가 필요한 경우 **사용하는 팀에서** 직접 작성

3. Private API

   - 팀 내부에서만 사용 가능
   - 도메인 규칙 없음
   - 포맷, 문서화는 팀 내 규약에 따라 자유롭게 관리
   - 하위호환 유지할 필요 없음



#### Public/Protected API는,

- HTTP 1.1 이상을 지원해야 한다.
- REST 혹은 GraphQL 기반으로 작성되어야 한다.
- [Swagger](https://swagger.io/) 형식의 스펙문서를 제공해야 한다.
- 통합테스트를 구축하고 자동화해야 한다.
   - [Postman](https://www.getpostman.com/)
   - [lightweight-rest-tester](https://github.com/ridibooks/lightweight-rest-tester)


<br>


## 리소스 서버에서의 인가(Authorization)

인가가 필요한 경우에는 JWT(JSON Web Tokens)를 이용할 수 있다.

1. OAuth2 클라이언트의 요청은 HS256(HMAC SHA-256) 알고리즘으로 서명한다.
   - 비밀키는 해당 클라이언트의 `client_secret`이어야 한다.
2. 신뢰할 수 있는 서버로부터의 요청은 RS256(RSA Signature SHA-256) 알고리즘으로 서명한다.
   - 마이크로서비스간의 리소스 요청이 이에 해당한다.
   - 요청자(iss)와 주제(sub) 조합에 따라 구분되는 대칭키 쌍을 사용해야 한다.
   - 비밀키의 보관은 요청 서버를 관리하는 팀에서 책임진다.
3. JWT는 `Authentication`헤더의 `Bearer` 토큰으로 전달되어야 한다.


<br>

## HTTP API 작성 가이드

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


<br>

## HTTP 상태 코드
다양한 response code를 사용하면 그 자체로 명시적이지만 코드 관리가 어려워진다는 단점이 있다.
따라서 아래 명시된 보편적인 response code만을 사용하고 더 자세한 내용은 message-body에서 제공한다.

| 상태 코드                     | 의미                      | 용도                                       |
| ------------------------- | ----------------------- | ---------------------------------------- |
| 200 OK                    | 성공적으로 처리                | 에러 응답에 대해서 사용하지 않도록 한다                   |
| 201 Created               | 리소스 생성 완료               | 가능하면 응답 헤더 Location필드에 리소스를 접근할 수 있는 URI를 포함시킨다. |
| 204 No Content            | 내용없음                    | 요청 처리 성공 후 특별히 message body에 포함시킬 내용이 없는 경우 사용한다. |
| 301 Moved Permanently     | 요청한 리소스가 새로운 URI를 부여받았음 | 새 URI를 응답 헤더 Location필드에 명시한다.           |
| 302 Found                 | URI가 임시로 변경됨            | 301과 비슷하지만 일시적으로 옮겨진 경우에만 사용한다.          |
| 304 Not Modified          | 요청한 리소스가 변경되지 않음        | If-Modified-Since 요청 헤더에 대한 응답으로 활용될 수 있다. |
| 400 Bad Request           | 잘못된 요청                  | 정의되지 않은 형식이나 보내면 안되는 요청에 대한 응답.          |
| 401 Unauthorized          | 리소스 접근 권한이 없음           | 가능하면 응답에 인증에 관한 정보를 포함시켜 필요한 경우 클라이언트에서 추가 요청을 보낼 수 있도록 한다. |
| 403 Forbidden             | 숨겨진 리소스에 접근하려 함         | 필요하다면 거부된 이유를 응답에 포함시키고,아예 공개할 의사가 없다면 404: Not Found를 사용한다. |
| 404 Not Found             | 매칭되는 URI가 없음            | 실제 리소스가 존재하더라도 존재 여부를 노출시키지 않고 싶은 경우에 사용할 수 있다. |
| 429 Too Many Requests     | 너무 많은 요청                | 가능하면 얼마나 기다린 후에 새로운 요청을 받을 수 있는지 응답 헤더의 Retry-After필드에 명시한다. |
| 500 Internal Server Error | 서버 에러                   | 요청은 정상적으로 받았지만 서버 처리 중 문제가 발생할 경우 전반에 사용한다. |
| 502 Bad Gateway           | 게이트웨이 에러                | 서버가 게이트웨이나 프록시로 사용 중인 경우 upstream서버에 이상이 있을 때 사용한다. |
| 503 Service Unavailable   | 서비스 이용 불가               | 대기 시간을 알 수 있다면 응답 헤더의 Retry-After필드에 명시한다. |



### 참고

- [RFC 2616](https://www.w3.org/Protocols/rfc2616/rfc2616.html)
- [OAuth 2.0](https://oauth.net/2/)
- [JWT](https://jwt.io/)
- [Choosing an HTTP Status Code — Stop Making It Hard](http://racksburg.com/choosing-an-http-status-code/)
- [API Error Handling](http://nordicapis.com/best-practices-api-error-handling/)
- [그런 REST API로 괜찮은가](http://tv.naver.com/v/2292653)
