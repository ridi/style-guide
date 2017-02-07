# HTTP 상태 코드 규칙
다양한 response code를 사용하면 그 자체로 명시적이지만 코드 관리가 어려워진다는 단점이 있다.
따라서 아래 명시된 response code만을 사용하고 더 자세한 내용은 message-body에서 제공한다.

#### 다음 기준으로 결정
- 추가 동작이 필요할 수 있는 경우
- 브라우저, 검색엔진 최적화 여지가 있는 경우
- 단순 정보 제공의 의미만 가지는 경우는 최대한 배제

##### 200: OK
  - 성공적으로 처리.
  - 에러 응답에 대해서 사용하지 않도록 한다

##### 201: Created
  - 리소스 생성 완료.
  - 가능하면 응답에 리소스를 접근할 수 있는 URI를 포함시켜 필요한 경우 클라이언트에서 추가 요청을 보낼 수 있도록 한다.
    
##### 301: Moved Permanently
  - 요청한 리소스가 새로운 URI를 부여받았음
  - 새 URI를 응답 헤더 Location필드에 명시한다. 
    
##### 304: Not Modified
  - 요청한 리소스가 변경되지 않음.
  - If-Modified-Since 요청 헤더를 이용하여 브라우저 캐시 사용을 유도하는데 사용한다.
    
##### 400: Bad Request
  - 잘못된 요청.
  - 정의되지 않은 형식이나 부적절한 빈도, 모순된 상황 모두 포함하여 보내면 안되는 요청에 대한 응답.
    
##### 401: Unauthorized
  - 리소스 접근 권한이 없음.
  - 가능하면 응답에 인증에 관한 정보를 포함시켜 필요한 경우 클라이언트에서 추가 요청을 보낼 수 있도록 한다.
    
##### 404: Not Found
  - 매칭되는 URI가 없음.
  - 실제 리소스가 존재하더라도 존재 여부를 노출시키지 않고 싶은 경우 사용할 수도 있다.
    
##### 500: Internal Server Error
  - 서버 에러.
  - 요청은 정상적으로 받았지만 서버 처리 중 문제가 발생할 경우 전반에 사용한다.
    
#### 참고
  - [RFC 2616](https://www.w3.org/Protocols/rfc2616/rfc2616.html/)
  - [Choosing an HTTP Status Code — Stop Making It Hard](http://racksburg.com/choosing-an-http-status-code/)

