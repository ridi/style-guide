# HTTP 상태 코드 규칙
현재 가장 널리 사용되고 있는 HTTP 1.1 규약을 따른다.

------

#### [I. Response Class Code](#def-response-class-code)

#### [II. 응답코드 결정하기](#def-flow-chart)
  - [Response Class 결정하기](#def-flow-chart-response-class)
  - [2XX/3XX인 경우](#def-flow-chart-2XX/3XX)
  - [4XX인 경우](#def-flow-chart-4XX)
  - [5XX인 경우](#def-flow-chart-5XX)

#### [III. Status Code 정의](#def-status-code-define)

  - [1XX: Informational](#def-1XX)

  - [2XX: Success](#def-2XX)
    - [200: OK](#def-200)
    - [201: Created](#def-201)
    - [202: Accepted](#def-202)

  - [3XX: Redirection](#def-3XX)
    - [301: Moved Permanently](#def-301)
    - [302: Found](#def-302)
    - [303: See Other](#def-303)

  - [4XX: Client Error](#def-4XX)
    - [400: Bad Request](#def-400)
    - [401: Unauthorized](#def-401)
    - [403: Forbidden](#def-403)
    - [404: Not Found](#def-404)
    - [405: Method Not Allowed](#def-405)
    - [406: Not Acceptable](#def-406)
    - [409: Conflict](#def-409)
    - [412: Precondition Failed](#def-412)
    - [415: Unsupported Media Type](#def-415)
    - [429: Too Many Requests](#def-429)

  - [5XX: Server Error](#def-5XX)
    - [500: Internal Server Error](#def-500)
    - [502: Bad Gateway](#def-502)
    - [503: Service Unavailable](#def-503)

------

<a name="def-response-class-code"></a>
# I. Response Class Code

HTTP 상태 코드는 100번대 단위로 응답 코드가 구분되어 있다.
첫번째 숫자값을 Response Class Code라고 하며 각 의미는 아래와 같다.

| Response Class Code | 의미          | 설명                            |
|---------------------|---------------|---------------------------------|
| 1                   | Informational | 진행중.                         |
| 2                   | Success       | 정상적으로 처리함.              |
| 3                   | Redirection   | 완료를 위해 추가 동작이 필요함. |
| 4                   | Client Error  | 클라이언트 요청에 문제가 있음.  |
| 5                   | Server Error  | 서버에서 처리를 하지 못함.      |

------

<a name="#def-flow-chart"></a>
# II. 응답코드 결정하기

<a name="#def-flow-chart-response-class"></a>
#### Response Class 결정하기
![flow-chart](/images/response_class.png)

<a name="#def-flow-chart-2XX/3XX"></a>
#### 2XX/3XX인 경우
![flow-chart](/images/2XX3XX.png)

<a name="#def-flow-chart-4XX"></a>
#### 4XX인 경우
![flow-chart](/images/4XX.png)

<a name="#def-flow-chart-5XX"></a>
#### 5XX인 경우
![flow-chart](/images/5XX.png)

------

<a name="#def-status-code-define"></a>
# III. Status Code 정의

<a name="def-1XX"></a>
#### 1XX (진행중)

   - 완전한 응답이 아니므로 실제 서버에서 사용하지 않는다.


<a name="def-2XX"></a>
#### 2XX (정상적으로 처리)

  <a name="def-200"></a>
  + 200: OK
    - 성공.
    - 어떤 요청이었는가에 따라 의미가 달라진다.
    - 요청이 성공적으로 완료되었음을 의미하므로 에러 응답에 사용하지 않는다.

  <a name="def-201"></a>
  + 201: Created
    - 리소스 생성 완료.
    - 도큐먼트 추가 등으로 새로운 리소스가 생성된 경우 사용하는 응답이다.
    - 응답 헤더의 Location필드에 생성된 리소스를 접근할 수 있는 URI를 포함시킨다.
    - 반드시 응답 전에 리소스가 생성되어야 한다. 만약 응답 전에 완료할 수 없는 경우엔 202: Accepted 코드를 사용한다.

  <a name="def-202"></a>
  + 202: Accepted
    - 비동기 요청에 대한 응답
    - 요청한 프로세스가 완료될 때까지 접속을 유지해야 할 필요가 없는 경우 사용한다.
      (ex 하루에 한번만 실행하는 batch 프로세스에 대한 요청)
    - 응답에는 사용자가 요청이 언제 완료될 지 예측할 수 있는 정보를 포함한다.
      (ex 예상 경과 시간, 프로세스를 모니터링 할 수 있는 페이지 주소)


<a name="def-3XX"></a>
#### 3XX (완료를 위해 추가 동작이 필요)

  <a name="def-301"></a>
  + 301: Moved Permanently
    - 요청한 리소스가 새로운 URI를 부여받았음.
    - 반드시 새 URI를 응답 헤더의 Location필드에 명시한다.

  <a name="def-302"></a>
  + 302: Found
    - URI가 임시로 변경됨.
    - 301과 비슷하지만 일시적으로 옮겨진 경우에만 사용한다.
    - 클라이언트 캐시나 검색엔진 최적화와 관련있으므로 301과 잘 구분해야 한다.
      임시로 변경되었다고 판단하기 때문에 캐시하지 않거나 검색결과에 반영하지 않는다.
      (https://www.hochmanconsultants.com/301-vs-302-redirect/)

  <a name="def-303"></a>
  + 303: See Other
    - 이미 다른 URI에 리소스가 존재함.
    - 존재하는 리소스에 대해 POST 요청을 한 경우 GET 메서드로 리다이렉트시키기 위해서 사용한다.
    - 응답 헤더의 Location 필드에 존재하는 URI를 명시한다.
    - HTTP/1.1 이전 클라이언트들은 303 응답을 처리하지 못할 수 있다. 이런 경우 302: Found를 대신 사용한다.


<a name="def-4XX"></a>
#### 4XX (클라이언트 요청에 문제가 있음)

  <a name="def-400"></a>
  + 400: Bad Request
    - 요청 실패.
    - 클라이언트가 잘못된 형식으로 요청한 경우 사용한다.
    - 가능한 경우 더 자세한 의미를 내포하는 4XX 코드를 사용한다.

  <a name="def-401"></a>
  + 401: Unauthorized
    - 리소스 접근 권한이 없음.
    - 응답은 WWW-Authenticate 헤더 필드를 명시하여 클라이언트에게 인증을 시도할 수 있도록 한다.
    - 만약 클라이언트가 이미 Authorization 헤더로 인증을 시도했다면 인증이 거절되었다는 정보를 포함시킨다.

  <a name="def-403"></a>
  + 403: Forbidden
    - 숨겨진 리소스에 접근하려 함.
    - 401과 다르게 인증과 상관없이 리소스를 공개하지 않는다.
    - 필요하다면 거부된 이유를 응답에 포함시키고,아예 공개할 의사가 없다면 404: Not Found를 사용한다.

  <a name="def-404"></a>
  + 404: Not Found
    - 매칭되는 URI가 없음.
    - 보통 요청이 거부되었고 왜 거부되었는지 이유를 밝히고 싶지 않은 경우 사용한다.

  <a name="def-405"></a>
  + 405: Method Not Allowed
    - 허용되지 않은 메서드.
    - 요청한 URI에 대해 해당 메서드가 허용되지 않은 경우 사용한다.
    - 반드시 응답 Allow헤더에 허용되는 메서드 리스트를 포함시켜야 한다.

  <a name="def-406"></a>
  + 406: Not Acceptable
    - 해당 미디어 타입을 지원하지 않음.
    - 요청 Accept 헤더에 명시된 타입에 대해 지원이 불가능한 경우에 사용한다.

  <a name="def-409"></a>
  + 409: Conflict
    - 충돌로 인해 완료되지 못함.
    - 보통 특정 리소스에 대한 처리 중 다른 요청이 먼저 처리되어 충돌이 발생한 경우에 사용한다.
      (ex 삭제된 리소스의 삭제, 업데이트 처리 중 version 충돌)
    - 응답에는 충돌이 어떻게 발생되었고 어떤 방법으로 해결할 수 있을지에 대한 힌트를 포함시킨다.

  <a name="def-412"></a>
  + 412: Precondition Failed
    - 사전 조건 실패.
    - meta데이터를 통해서 요청이 정확히 의도된 곳에 적용되도록 사전 조건을 제공할 수 있는데 (ex 요청 헤더의 If-Match, If-Modified-Since, If-Range 필드 등) 이런 조건들을 통과하지 못한 경우 사용한다.

  <a name="def-415"></a>
  + 415: Unsupported Media Type
    - 지원하지 않는 미디어 유형.
    - 요청 헤더의 Content-Type이 서버에서 지원하지 않는 타입인 경우에 해당한다.

  <a name="def-429"></a>
  + 429: Too Many Requests
    - 너무 많은 요청.
    - 클라이트가 주어진 시간동안 지나치게 많은 요청을 보낸 경우 사용한다.
    - 응답 헤더의 Retry-After필드에는 얼마동안 기다려야 새로운 요청을 받을 수 있는지 명시한다.


<a name="def-5XX"></a>
#### 5XX (서버에서 처리를 하지 못함)

  <a name="def-500"></a>
  + 500: Internal Server Error
    - 서버 에러.
    - 서버 처리 중 의도치 않은 상항에 빠진 경우 사용한다.

  <a name="def-502"></a>
  + 502: Bad Gateway
    - 게이트웨이 에러.
    - 서버가 게이트웨이나 프록시로 사용 중인 경우 upstream서버에 이상이 있을 때 사용한다.

  <a name="def-503"></a>
  + 503: Service Unavailable
    - 서비스 이용 불가.
    - 현재 서버가 일시적으로 이용이 불가능한 경우에 사용한다. (과부하나 점검 등)
    - 대기 시간을 알 수 있다면 응답 시 Retry-After 헤더에 명시한다.
 
 