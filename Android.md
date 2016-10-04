
# Android 코딩 스타일

## Kotlin 코딩 스타일

Kotlin 공식 문서의 [Coding Convention](http://kotlinlang.org/docs/reference/coding-conventions.html)을 따른다.
이 외에 차이점이나 추가 사항은 아래와 같다.

### 네이밍
- 타입 이름은 대문자로 시작한다. (ex. int -> Int, float -> Float, ...)
- 변수의 이름은 카멜케이스를 적용한다.
- Kotlin은 기본적으로 '필드'가 아닌 '프로퍼티'를 갖는다.
  - as_, m_과 같은 접두어를 프로퍼티 이름에 사용하지 않는다.
  - 프로퍼티의 Backing field에 접근해야할 때에는 $를 사용한다. (ex. property라는 프로퍼티가 있을 때 -> $property.~~)
 
### 콜론
- 타입과 슈퍼타입 사이에서 구분이 필요할 경우에는 콜론 앞뒤로 공백을 한 칸 넣고,
- 인스턴스와 타입 사이에서 구분이 필요할 경우에는 콜론의 뒤에만 공백을 한 칸 넣는다.
- ex.
  ```kotlin
  class Foo : Bar { /*...*/ }
  fun foo(a: Int): Bar { /*...*/ }
  ```
 
### 유닛 (Unit)
- 함수가 특별히 쓸모 있는 값을 리턴하지 않을 경우, Unit 타입을 리턴한다.
- 하지만 그럴 경우에 Kotlin이 알아서 Unit을 리턴하기 때문에, 굳이 코드에는 명시하지 않는다.
- ex.
  ```kotlin
  fun foo(a: Int) { // 1. ': Unit'
      println(a)
      // 2. 'return Unit' 혹은 'return'
  }
  ```
  위 코드의 1번과 2번은 굳이 명시하지 않기로 한다.


## Java 코딩 스타일
 
안드로이드 오픈소스 프로젝트(AOSP)의 [Code Style Guidelines for Contributors](http://source.android.com/source/code-style.html)를 따른다.
이 외에 차이점이나 추가 사항은 아래와 같다.

- Indentation
  - Tab policy: Spaces only (Space만을 사용하고 들여쓰기는 4 spaces를 사용한다.)
- Naming
  - Field Prefixes: none (IDE에서 구분이 가능하므로 m이나 s 등의 prefix 붙이지 않음.)
  - Interface Prefixes: none
- Brace Style
  - brace 내 코드가 한줄이더라도 brace로 반드시 감싸는 것으로 한다.

  ```java
  class foo {}
  if (condition) {
      doSomething();
  }
  ```


## 리소스 네이밍

- layout
  - activty, fragment 등 담고 있는 내용의 최상단 개념을 prefix로 한다.
  - 그 이후는 상위 개념에서 하위 개념을 순차적으로 사용한다.
  - 예) activty_tutorial, fragment_shelf, shelf_toolbar
- drawable
  - 아이콘 이미지의 경우 icon을 prefix로 한다.
  - 그 이후는 상위 개념에서 하위 개념을 순차적으로 사용한다.
  - 예) shelf_toolbar_more_button.png, shelf_toolbar_background.png
- id
  - 간단한 의미를 이름으로 쓴다.
  - ImageButton, Button, CheckBox, RadioButton과 같이 Button 종류이거나 Button의 Subclass인 경우 button을 postfix로 한다.
  - ProgressBar, SeekBar의 경우 bar를 postfix로 한다.
  - ViewGroup의 경우 container를 postfix로 한다.
  - 예)
    ```xml
    <?xml version="1.0" encoding="utf-8"?>
    <LinearLayout xmlns:android="http://schemas.android.com/apk/res/android"
      android:id="@+id/toolbar_container"
      android:layout_width="match_parent"
      android:layout_height="wrap_content">
    
      <ImageView android:id="@+id/cover"
          layout_width="wrap_content"
          layout_height="wrap_content" />
    
      <Button android:id="@+id/download_button"
          layout_width="wrap_content"
          layout_height="wrap_content" />
    
    </LinearLayout>
    ```

- View variable naming
  - 위의 id와 동일한 형태로 사용하되 camel case를 사용한다.
  - 만약 TextView나 ImageView를 버튼 같은 용도로 사용한다면 Button을 postfix로 사용한다.
  - 예)
    ```java
    TextView bookTitleView = (TextView) findViewById(R.id.book_title);
    ImageView coverView = (ImageView) findViewById(R.id.cover);
      
    Button downloadButton = (Button) findViewById(R.id.download_button);
    ImageButton deleteButton = (ImageButton) findViewById(R.id.delete_button);
    TextView confirmButton = (TextView) findViewById(R.id.confirm_button);
      
    ProgressBar downloadBar = (ProgressBar) findViewById(R.id.download_bar);
    SeekBar pageBar = (SeekBar) findViewById(R.id.page_bar);
    CheckBox syncButton = (CheckBox) findViewById(R.id.sync_button);
    RadioButton koreanDicButton = (RadioButton) findViewById(R.id.korean_dic_button);
    ```

## 참고
- [Google Java Style Guide](https://google.github.io/styleguide/javaguide.html)
- [MDN(Mozilla Developer Network)의 Java Coding Style](https://developer.mozilla.org/en-US/docs/Mozilla/Developer_guide/Coding_Style#Java_practices)
