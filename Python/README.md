# Python 코딩 스타일

코드 규약은 [PEP8](https://www.python.org/dev/peps/pep-0008/)과 [Google의 스타일 가이드](https://google.github.io/styleguide/pyguide.html)를 최대한 따른다.
위 가이드에서 중요한 부분이나 언급되지 않은 부분 그리고 서로 상충되는 부분은 따로 아래에 기술한다.


## 추가 규칙
- 리스트, 튜플, 딕셔너리 사용시 마지막에 , 를 붙인다.(Trailing commas)
  - 이유는 데이터 추가시 Diff 보기 편하다.

- 파이썬 패키지 에서 __init__.py 를 만들지 말자.

- 예외 Exception
  - 예외는 클래스로 만들어서 사용한다.
  
- import 
  - pycharm 의 Code > Optimize Imports 기능을 수행한다.
  - import 할 때 * 사용하지 말자.
- 상속
  - 상속은 오른쪽으로 진행한다.
  - Mixin은 기본 부모에서부터 왼쪽으로 진행한다.
  - 무조건 최상위 부모는 object 이어야 한다.

- 가독성 관련
    - 반복문과 분기를 한 라인이 같이 담는 식의 코드를 작성하지 않는다.
    ```python
    content_ids = [content.id for content in contents if content is not None]
    ```

## 변경 규칙
- 1행에 140자까지 사용한다.
- 줄바꿈, 공백
  - 들여쓰기는 공백 4칸을 사용한다.
  - 최상위(top-level) 함수와 클래스 정의는 2줄씩 띄어쓴다.
  - 클래스 내의 메소드 정의는 1줄씩 띄어쓴다.
  - 키워드 인자(keyword argument)와 인자의 기본값(default parameter value)의 = 는 붙여 쓴다.
  - 함수 인자 (아래 둘다 된다., _ 는 공백을 나타낸다.)
  
    ```
    foo = long_function_name(
    ________var_one, var_two,
    ________var_three, var_four
    ________)
    print(var_one)
    ```
    ```
    foo = long_function_name(
    ________ var_one, var_two, var_three, var_four
    ________)
    print(var_one)
    ```

## 강조규칙

- 세미콜론을 사용하지 않는다. 
  - 2개의 command 를 세미콜론을 사용해 한라인에 표현이 가능하지만 사용하지 않는다.
  
    
- 클래스
  - 인스턴스 메소드의 첫 번째 인자는 언제나 self 이다.
  - 클래스가 특정 클래스를 상속하지 않으면 object 로 한다.
  - 클래스 메소드의 첫 번째 인자는 언제나 cls 이다.
  - 클래스에서 private 맴버나 메소드는 이름 앞에 밑줄을 추가한다.

- 비교
  - None과 비교, Boolean 비교는 is, is not 을 사용한다.
  - 객체의 타입을 비교할 때는 isinstance() 를 사용한다.

- 문자열
  - string 모듈보다는 string 메소드를 사용한다.
    - 메소드가 모듈보다 빠르고 유니코드 문자열에 대해 같은 API 를 공유한다.
  - 접두사나 접미사를 검사할 때는 startswith()와 endwith()를 사용한다.

- 이름규칙
  - module_name, package_name, ClassName, method_name, ExceptionName, function_name, GLOBAL_CONSTANT_NAME, global_var_name, instance_var_name, function_parameter_name, local_var_name.


## Pylint

Pylint 설치
`pip3 install pylint`

Pylint 설치 위치 확인
`which pylint`


## PyCharm

- Preferences > Editor
  - Code Style
    - Line separator (for new files): Unix and OS X (\n)
    - Right Margin (columns) : 120
  - Code Style > Python >  Other
    - (check) Add line feed at the end of file
    - (check) Use continuation indent for arguments

- Preferences > External Tools
  - + 버튼을 눌러서 Pylint 추가
    - Name: Pylint
    - Program: which 로 찾은 경로 입력
    - Parameters: $FilePath$
  - Tools > External Tools > Pylin 체크되어 있는지 확인
