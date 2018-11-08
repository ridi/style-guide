
# Android 코딩 스타일

[EditorConfig 파일](.editorconfig)

[Android Studio 설정](AndroidStudio/README.md)

## Kotlin 코딩 스타일

Kotlin 공식 문서의 [Coding Convention](http://kotlinlang.org/docs/reference/coding-conventions.html)과 [Android Kotlin Guides](https://android.github.io/kotlin-guides/style.html)를 따른다. 차이점이나 추가 사항은 아래와 같다.

- Column limit은 120을 사용한다.
- Boolean을 부정할 때는 ! 대신 not()을 사용한다.
- 특별히 명시되지 않은 부분은 기본적으로 Java의 convention을 따르도록 한다.

## Java 코딩 스타일

[Google Java Style Guide](https://google.github.io/styleguide/javaguide.html)를 따른다.
이 외에 차이점이나 추가 사항은 아래와 같다.

- Column limit은 120을 사용한다.
- Block indentation은 +4 spaces를 사용한다.
- Static import는 사용하지 않는다.

## 공통 코딩 스타일

- 소스코드 상단에 저작권 및 저자를 표시하는 주석은 남기지 않는다.

## 리소스 네이밍

- layout
  - activty, fragment 등 담고 있는 내용의 최상단 개념을 prefix로 한다.
  - 그 이후는 상위 개념에서 하위 개념을 순차적으로 사용한다.
  - 예) activty_tutorial, fragment_shelf, shelf_toolbar
- drawable
  - 기본적으로 상위 개념에서 하위 개념을 순차적으로 표기한다. 
  - 특정 상위, 하위 개념에 속하지 않거나, 여러 코드에 공통으로 사용할 경우에는 표기하지 않는다.
  - 예) reader_typo_setting_column_width.xml, simple_noti_icon_error.png
  - 아이콘(icon), 버튼(btn), 배경(bg), 셀렉터(sel)등 리소스의 종류를 상, 하위 개념 다음에 함께 표기한다. 
    상, 하위 개념과 리소스의 종류를 표기 한 뒤 기능과 모양에 어울리는 이름을 자유롭게 추가한다.
  - 예) reader_tts_**icon**\_pre.png / main_purchased_**btn**\_book_read.png
  - 리소스 상위, 하위개념의 영어 명칭은 안드로이드에 현재 개발된 상태를 참고하여 표기한다.
  - 예) 내 서재(library), 개별 책장(shelf), 구매목록(purchased), 서점(store), 설정(settings), 
  - 책장 목록(shelf_list), 최근 읽은 책(recent_book), 독서노트(reading_note), 보기 설정(typo_setting), 뷰어 설정(reader_setting)
  - 테마에 따라 리소스를 구분해야하는 경우, 다크 테마용 리소스의 맨 뒤에 _d를 붙인다.
  - 예) main_shelf_icon_uncheck_d.xml
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

## TextView 설정
- 2줄이상의 텍스트가 들어갈 경우 `lineSpacingMultiplier`를 `1.15`로 설정한다.
- 디자인 가이드 상에 Medium으로 표현된 폰트일 경우 `bold` 속성을 적용한다.