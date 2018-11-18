# 오픈 소스

## Open First Initiative

일반적으로 기업에서 관리되는 소프트웨어는 외부에 공개될 때 문제의 소지가 있을 것을 우려하여 독점 라이선스로 개발됩니다.

Open First Initiative는 이러한 통념과는 반대로 "대부분의 소프트웨어는 외부에 공개되어도 문제가 없다"는 점에 주목하여 **오픈 소스 라이선스를 우선하려는** 정신입니다.

### 장점

- 보다 책임감을 가지게 됩니다.
  - 평소의 작업물이 공개된 상태로 영구히 기록된다는 것은 건강한 부담입니다.
  - 변수명 하나, 주석 한 줄을 작성하더라도 우리를 조금 더 신중하고 사려 깊게 만듭니다.
- 커리어에 도움이 됩니다.
  - 공개된 결과물이 쌓인다는 것은 자신을 투명하게 검증할 수 있는 하나의 수단이 생긴다는 것을 의미합니다.
- 누군가에게 도움이 될 수 있습니다.
  - 완성도 높은 솔루션이 되어야만 커뮤니티에 기여할 수 있는 것은 아닙니다.
  - 비슷한 고민을 하고 있는 개발자들에게 때로는 스택 오버플로우보다 가치 있는 레퍼런스가 되기도 합니다.
- 보안에 도움이 됩니다.
  - 게으름과 귀찮음으로 말미암아 서비스 주요 암호와 비밀키가 하드코딩되는 사례를 예방할 수 있습니다.
  - 키를 제외한 시스템의 다른 모든 내용이 알려지더라도 암호체계는 안전해야 한다는 [암호학의 기본 원칙](https://en.wikipedia.org/wiki/Kerckhoffs%27s_principle)을 준수하게 됩니다.
- 개발 도구들이 무료로 제공되기도 합니다.
  - GitHub 마켓플레이스에서 제공되는 많은 서비스들은 오픈소스에 한하여 무료로 제공됩니다.

### 단점

- 단기적인 생산성이 저하됩니다.
  - 장점으로 언급된 내용을 고려하다 보면 초기 개발 속도가 다소 느릴 수 있습니다.
  - 하지만 마치 코드 리뷰와 테스트 자동화가 그러하듯이, 조금 천천히 가는 것이 결국에는 더 높은 생산성을 냅니다.
- 미숙함이 외부에 적나라하게 노출됩니다.
  - 이는 기업의 이미지와도 관련이 되어있어 채용이나 사업에 나쁜 영향을 주기도 합니다.
  - 하지만 현재의 미숙함을 인정하고 나아지려는 노력을 하는 것이 본 모습을 포장하고 안주하려는 것보다 언제나 옳습니다.
- 버전 관리, 호환성 관리 및 문서화를 위한 노력이 필요합니다.
  - 하지만 원래 하지 않던 일이 사실은 필요했던 일이었을지도 모릅니다.
  - 기존에는 특정 인물을 통해서 구전되던 개발 환경 설정과 같은 지식이 명문화되기도 합니다.

<br>

## GitHub 관리

사내에서 개발하는 오픈소스는 GitHub에서 관리하고 있습니다.

인입되는 이슈와 PR을 놓치지 않기 위해, 모든 저장소에는 관리자(Maintainer)와 관리팀이 있어야 합니다.

- 관리자는 해당 프로젝트의 👁‍🗨Watcher에 포함되어 있어야 합니다.
- 관리자는 해당 프로젝트의 Admin 권한을 가집니다.


## 오픈소스 라이선스

- 새롭게 생성하는 프로젝트는 반드시 [MIT](https://opensource.org/licenses/MIT) 라이선스를 사용합니다.
  - MIT는 간결하고 직관적이며 비공개 프로젝트에도 쉽게 사용될 수 있기 때문입니다.
- 저장소 최상위에 `LICENSE` 파일을 추가해야 합니다.
  - 모든 소스코드의 최상단에 라이선스를 표시할 필요는 없습니다.
- 라이선스 템플릿은 아래와 같습니다.
  ```
  MIT License

  Copyright (c) [YEAR] RIDI Corporation

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
  SOFTWARE.
  ```

  - `[YEAR]`에는 라이센스가 발효된 년도를 기입하고, 시간이 지나도 업데이트하지 않습니다.

