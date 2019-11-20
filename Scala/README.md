# Scala 코딩 스타일 가이드

Scala 코딩 스타일은 기본적으로 다음 두 문서를 참조한다.
 - [The Official Scala Style Guide](https://docs.scala-lang.org/style/)
 - [Databricks Scala Style Guide](https://github.com/databricks/scala-style-guide)

두 문서의 코드 스타일 정의에 충돌이 있는 경우 [Databricks Scala Style Guide](https://github.com/databricks/scala-style-guide)를 우선적으로 따른다.

## Tools
위 코드 스타일 가이드의 내용을 모두 숙지하고 있기는 현실적으로 어렵기 때문에, 최대한 적절한 도구의 도움을 받는 것을 원칙으로 한다.

현재 사용 중인 도구는 다음과 같다.

- [Scalafmt](https://scalameta.org/scalafmt/)
  - Scala 코드를 정해진 규칙에 따라 Reformating 해준다.
  - IDE의 scala formatter 로 설정하여 사용한다.
- [Scalastyle](http://www.scalastyle.org/)
  - Scala 코드에서 잠재적으로 문제가 될 수 있는 부분을 검사하여 알려준다.
  - IDE의 Code Inspector에서 동작하도록 설정하여 사용한다.

:warning: 설정 가이드
  - 최대한 [Databricks Scala Style Guide](https://github.com/databricks/scala-style-guide)를 따르도록 설정하되, 코드베이스의 특성에 따라 예외 항목을 둘 수 있다.
  - Scalafmt와 Scalastyle 설정이 충돌하지 않아야 한다.
    - Scalafmt를 사용하여 Reformat된 코드가 Scalastyle 설정에서 문제가 되는 코드로 표기되지 않아야 한다.
    - Scalastyle에서 `import` 정렬과 관련된 규칙이 있는 경우 Scalafmt에서 이를 따르도록 설정한다.
  - Scalastyle의 모든 체크 항목의 level을 `"error"`로 설정한다.
    - 에디터 상에서 오류처럼 표기되어야 코드 작성자가 스타일에 맞지 않는 코드를 쉽게 인지하고 수정할 수 있다.

## IDE(Integrated Development Environment)

IDE로는 [IntelliJ IDEA](https://www.jetbrains.com/idea/)를 사용을 권장한다.

<details><summary>IntelliJ에서 사용가능한 플러그인 및 적용방법</summary>
<p>

#### Plugins

스칼라 코드 개발에 사용되는 플러그인들은 다음과 같다.

- [Scala Plugin](https://plugins.jetbrains.com/plugin/1347-scala/)
- [SBT Plugin](https://plugins.jetbrains.com/plugin/5007-sbt/)
- [Scalafmt Plugin](https://plugins.jetbrains.com/plugin/8236-scalafmt/)

#### Scalafmt 적용

1. [Scalafmt Plugin](https://plugins.jetbrains.com/plugin/8236-scalafmt) 설치
2. (선택) 프로젝트 root에 `.scalafmt.conf` 설정 파일 추가
3. IntelliJ의 `Preferences` 메뉴에서 다음 항목 설정
    - `Preferences > Editor > Code Style > Scala`
      - (필수) Formatter 목록에서 `scalafmt` 선택
      - (권장) 하단 `Scalafmt` 탭에서 `Reformat on file save` 체크
      - (권장) 만일 Scalastyle 설정에 import 순서도 정의되어 있다면
        - `Imports` 탭에서 `Sort imports (for optimize imports)` 항목 체크
          - `scalastyle consistent` 선택

#### Scalastyle 활성화

1. 프로젝트 root에 `scalastyle-config.xml` 설정 파일 추가
2. IntelliJ의 `Preferences` 메뉴에서 다음 항목 설정
  - `Preferences > Editor > Inspections`
    - `Scala 항목 체크`

</p>
</details>

## 참고자료
Scala 코딩 스타일 가이드
- [The Official Scala Style Guide](https://docs.scala-lang.org/style/)
- [Databricks Scala Style Guide](https://github.com/databricks/scala-style-guide)
- [Spotify Scio Scala Style Guide](https://spotify.github.io/scio/dev/Style-Guide.html)

설정파일
- [apache/spark/scalastyle-cofig.xml](https://github.com/apache/spark/blob/master/scalastyle-config.xml)
- [spotify/scio/scalastyle-config.xml](https://github.com/spotify/scio/blob/master/scalastyle-config.xml)
- [spotify/scio/.scalafmt.conf](https://github.com/spotify/scio/blob/master/.scalafmt.conf)
