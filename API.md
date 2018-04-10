# HTTP API 설계 원칙

API는 공개 수준에 따라 아래의 3가지로 구분하며, 가능한 높은 공개 수준을 지원해야 한다.

1. Public API

   - 서드파티 혹은 임의의 개인이 사용 가능
   - FQDN: `api.ridibooks.com`
     - 도메인은 API Gateway에 연결되어 있으며, 변경 필요시 [@ridi/performance](https://github.com/orgs/ridi/teams/performance) 팀에 요청
   - 보안 프로토콜(TLS/SSL)을 사용해야 함
   - 인증에는 OAuth 2.0을 사용
     - [인증 서버 구현체](https://github.com/ridi/account) 및 [Python](https://github.com/ridi/django-oauth2), [PHP](https://github.com/ridi/php-oauth2) 미들웨어 참고

2. Protected API

   - 세컨드파티 혹은 내부 직원만 사용 가능
   - FQDN:
     - 공인 IP가 있다면 `{team}-api.ridibooks.com`
     - 공인 IP가 없다면 `api.{team}.ridi.io`
   - 공인 IP를 가질 경우 보안 프로토콜(TLS/SSL)을 사용해야 함
   - 클라이언트 라이브러리가 필요한 경우 **사용하는 팀에서** 직접 작성

3. Private API

   - 팀 내부에서만 사용 가능
   - 도메인 규칙 없음
   - 포맷, 문서화는 팀 내 규약에 따라 자유롭게 관리
   - 하위호환 유지할 필요 없음



#### Public/Protected API는,

- HTTP 1.1 이상을 지원해야 한다.
- REST 혹은 GraphQL 기반으로 작성되어야 한다.
- [OpenAPI](https://swagger.io/specification/) 형식의 스펙문서를 제공해야 한다.
- 통합테스트를 구축하고 자동화해야 한다.
   - [Postman](https://www.getpostman.com/)
   - [lightweight-rest-tester](https://github.com/ridibooks/lightweight-rest-tester)


<br>


## 신뢰할 수 있는 서버간의 인가(Authorization)

마이크로서비스를 운영하다보면 내부 서버간, 즉 신뢰할 수 있는 서버간의 API 통신이 필요한 상황이 발생한다.
이 때 인가는 JWT(JSON Web Tokens)를 통해 이루어져야 하며, 사용되는 토큰은 아래의 조건을 만족해야 한다.

- iss(발급자)와 aud(수신자)에 팀 명 입력
  - aud 정보는 선택사항이며, 추가적인 검증을 위해 사용 가능
- sub(주제)에는 서비스명을 입력
- RS256(RSA Signature SHA-256) 알고리즘으로 서명
  - iss와 sub 조합에 따라 구분되는 비대칭키를 사용
  - 키의 관리는 비밀키를 사용하는 팀에서 책임질 것
- `Authorization`헤더의 `Bearer` 토큰으로 전달

예) 계정팀에서 플랫폼팀으로 책 정보를 요청하는 경우
```
{ // header
  "typ": "JWT",
  "alg": "RS256"
}
{ // payload
  "iss": "account",
  "sub": "book",
  "aud": "platform",
}
```


<br>

## 내부 서비스간의 SSO

마이크로서비스 환경에서 최종사용자의 SSO(Single Sign-On)를 지원하기 위해 OAuth2를 사용한다.
이 때 access token은 JWT(JSON Web Tokens) 형태로 발급되며, 사용되는 토큰은 아래의 조건을 만족해야 한다.

- HS256(HMAC SHA-256) 알고리즘으로 서명
  - 키는 OAuth2 서버와 리소스 서버가 공유
- 아래의 claim들이 payload에 제공되어야 함
  - sub: 리소스 소유자의 리디북스 ID
  - u_idx: 리소스 소유자의 고유 식별자(user_idx)
  - exp: 유닉스 시간으로 표현된 토큰 만료시간
  - client_id: 사전에 약속된 OAuth2 클라이언트 ID
  - scope: 토큰이 허용하는 인가 범위 (공백으로 구분)

예) 
```
{ // header
  "typ": "JWT",
  "alg": "HS256"
}
{ // payload
  "sub": "antiline",
  "u_idx": 12312233,
  "exp": 1518505258,
  "client_id": "**given_client_id**",
  "scope": "all"
}
```


<br>

## HTTP API 작성 가이드

- 첫 번째 Path Segment는 서비스명으로 시작한다.
  - 예) 검색 서비스: ```api.ridibooks.com/search/```
  - 예) 책 상세 서비스: ```api.ridibooks.com/books/```
 
- Path Segments를 표현할 때에는 [kebab-case](https://en.wikipedia.org/wiki/Letter_case#Special_case_styles) 를 사용할 것
  - 예) ```/reading-notes/{b_id}```
   
- Query Parameters에는 snake_case 를 사용할 것
 
- Trailing Slashes 를 사용하지 말 것
  - slash 를 사용한 경우와 사용하지 않은 경우 같은 결과를 반환해야 하고, / 를 붙이지 않는 것을 원칙으로 한다.

- API의 버전 관리를 위해 Path Segment에 `/v1`, `/v2` 따위를 포함하지 말 것
  - 다양한 버전을 관리하는 것은 테스트 및 유지보수 측면에서 매우 복잡하고 어려운 일이다.
  - 가장 좋은 것은 [API 버전을 관리하지 않는 것](https://martinfowler.com/articles/enterpriseREST.html#versioning)이며, 아래의 방법들 중 하나를 우선적으로 고려한다.
    1. 기존 리소스의 호환을 유지하며 확장
       - 기존 필드 삭제 금지
       - 신규 필드 추가만 가능
    2. 새로운 리소스를 정의
    3. 새로운 서비스 엔드포인트를 정의
  - 부득이 버전을 관리해야 한다면 HTTP `Content-Type` 헤더를 통한 Media Type 버저닝을 할 것
    - 예) `Accept: application/vnd.ridibooks.cart+json;version=2`

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
