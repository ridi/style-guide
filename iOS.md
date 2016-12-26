# iOS 코딩 스타일

## Swift 코딩 스타일 (draft)

[Ray Wenderlich의 스타일 가이드](https://github.com/raywenderlich/swift-style-guide)를 따르되 다음을 예외로 한다.

- Tab size는 4로 하고 space를 사용한다.

- 전역 변수 네이밍은 private일 때는 기존 프로퍼티 네이밍 규칙을 이용하고, public일 때는 'RB + className + 기존 프로퍼티' 네이밍을 이용한다.
  ```swift
  // Public
  let RBBookCoverDefaultImage = UIImage(named: "shelf_broken_cover")!
  ...
  
  // Private
  private let coverConnectionTimeoutSec: NSTimeInterval = 10
  ...
  
  @objc(RBBookCoverImage)
  class RBBookCoverImage: NSObject {
    ...
  }
  ```

- 콘솔로그를 남길 때는 'print'를 쓰지 않고 'NSLog'를 사용한다. (print는 스레드 정보나 시간이 출력되지 않음)

- if 문에 연속적인 let을 선언할 때 let은 생략하지 않도록 한다. (var일 때도 마찬가지)
  ```swift
  // Bad 
  if let userInfo = notification.userInfo,
    bookId = userInfo["bookId"] as? String {
      removeObjectForKey(bookId)
  }
  
  // Good
  if let userInfo = notification.userInfo,
    let bookId = userInfo["bookId"] as? String {
      removeObjectForKey(bookId)
  } 
  ```


## Objective-C 코딩 스타일

[Apple's Cocoa Coding Guidlines](https://developer.apple.com/library/content/documentation/Cocoa/Conceptual/CodingGuidelines/CodingGuidelines.html)와 [Google Objective-C Style Guide](https://google.github.io/styleguide/objcguide.xml)를 따르되 다음을 예외로 한다.

- Macro 상수 앞에 k를 붙이지 않고 대문자와 _로 이루어진 이름을 사용한다.

- Tab size는 4로 하고 space를 사용한다.

- Modern Objective-C Syntax를 사용한다. (주의 : nil이 있으면 error)
  ```obj-c
  NSArray *array = [[NSArray alloc] initWithObjects:@"value1", @"value2", nil];
  NSArray *modernArray = @[@"value1", @"value2"];
  
  NSDictionary *dictionary = [[NSDictionary alloc] initWithObjectsAndKeys:@"value1", @"key1", @"value2", @"key2", nil];
  NSDictionary *modernDictionary = @{@"key1": @"value1", "key2": @"value2", ...};
  
  NSNumber *number = [[NSNumber alloc] initWith...];
  NSNumber *modernNumber = @5; // @.5, @1.5, @YES, @(4 + 2)
  ```

- Brace 내 코드가 한 줄이더라도 brace로 반드시 감싸는 것으로 한다.
  ```obj-c
  if (condition) {
      doSomething();
  }
  ```


# 네이밍 규칙

## 리소스 네이밍

- 소문자만 사용한다
- 공백은 언더스코어(_)로 대체한다
- 접두어에는 폴더명, 컴포넌트명, 디자인 고유명이 있다
- 각 접두어는 언더스코어로 구분된다
- 여러 접두어를 사용할 경우 '폴더명', '컴포넌트명', '디자인 고유명' 순으로 사용한다
- 폴더명은 리소스가 속하는 뷰나 기능을 의미한다
    - share : 멋지게 공유하기 리소스
    - welcome : 월컴뷰 리소스
    - reader : 뷰어 리소스
- 폴더명은 상위 폴더명까지 포함한다
    - X) resources/reader/typo/*.png -> typo_xxx.png
    - O) resources/reader/typo/*.png -> reader_typo_xxx.png
    - O) resources/main/*.png -> main_xxx.png
    - O) resources/*.png -> xxx.png
- 폴더명이 없는 경우는 공용 리소스를 의미한다
- 폴더명은 언더스코어 없이 붙여 쓴다
- 컴포넌트명은 HIG에서 언급하는 UI Controls, UI Bars를 짧게 표현한 것이다
    - navbar
    - tabbar
    - toolbar
    - searchbar
    - bar
    - control
    - btn
    - switch
    - stepper
    - slider
    - spinner
- 컴포넌트명도 언더스코어 없이 붙여 쓴다
- 디자인 고유명은 아이콘이나 로고와 같이 디자인에서 통상적으로 쓰이는 고유명사이다 
    - icon
    - logo
    - bg
- 접미어에는 색상이나 크기, 위치, 순번, 테마, 상태가 있다
    - 색상 : reader_color_***black***.png
    - 크기 : welcome_logo_***large***.png
    - 위치 : selection_arrow_***left***.png
    - 순번 : customfont_tutorial_***1***.png
    - 테마 : icon_pagination_left_***d***.png
    - 상태 : icon_freebook_***on***.png
- 접미어 순서는 재량이다
- 테마 접미어에는 'd'와 생략이 있다
    - d : 다크 테마
    - 생략 : 화이트 테마
- 상태 접미어에는 되도록 다음 항목만 사용한다
    - normal
    - highlighted
        - X) pressed
    - selected
        - X) checked
    - disabled
    - on
    - off
- 위 항목과 유사한 의미가 아니라면 상태 접미어로 쓸 수 있다
    - bookmarked
    - closed
- 예시들
	- main_searchbar_icon_clear_d.png
	- main_tabbar_icon_settings.png
	- main_library_btn_recent_list.png
	- main_library_icon_download.png
	- main_cloud_navbar_search.png
	- reader_typo_btn_color_darkgray_selected.png
	- reader_typo_stepper_plus.png
	- reader_slider_thumb.png
	- reader_bar_listen_label.png
	- reader_rating_divider.png
	- reader_tts_icon_arrow_up.png
	- reader_shadow.png
	- share_bg_10.jpg
	- share_btn_sns_insta.png
	- shortcut_icon_recent_book.png
	- webview_bar_icon_refresh.png
	- welcome_btn_login_highlighted.png
	- welcome_logo_large.png


## 애플 리소스 네이밍

- 접미어에 orientaion, screenHeight, rate, interfaceIdiom이 있다
- 각 접미어는 상황에 맞춰 선택적으로 쓰이며 쓸 때는 알맞는 접두어를 사용해야 한다
    - ***-***[orientaion]
    - ***-***[screenHeight]
    - ***@***[rate]
    - ***~***[interfaceIdiom]
- 접미어는 위에서 언급한 순서대로 사용되어야 한다
    X) name-[rate]-[orientaion]
    X) name-[interfaceIdiom]-[rate]
    O) name-[screenHeight]-[rate]
- orientaion은 특정 회전 상태에만 쓰일 수 있도록 하는 접미어다
    - name-***P***ortrait.png     // 세로 모드에서만 사용
    - name-***L***andscape.png    // 가로 모드에서만 사용
    - name.png              // 생략했을 때는 모든 회전 상태에서 사용함을 의미
- screenHeight는 아이폰 크기가 파편화되면서 생긴 것으로 특정 크기에만 쓰일 수 있도록 하는 접미어다
    - name-568h.png         // 3.5~4.0인치에서만 사용
    - name-667h.png         // 4.7인치에서만 사용
    - name-736h.png         // 5.5인치에서만 사용
    - name.png              // 생략했을 때는 모든 크기에서 사용함을 의미
- rate는 특정 화면 배율에서 쓰일 수 있도록 하는 접미어다
    - name@3x.png           // 3x에서 사용
    - name@2x.png           // 2x에서 사용
    - name.png              // 생략했을 때는 1x에서 사용함을 의미
- interfaceIdiom은 특정 디바이스(iPhone/iPod, iPad)에서만 쓰일 수 있도록 하는 접미어다
    - name~ipad.png         // iPad에서만 사용
    - name~iphone.png       // iPhone/iPod에서만 사용
    - name.png              // 생략했을 때는 모든 디버이스에서 사용함을 의미
- 예시들
	- reader_paper_bg@2x.png
	- memo_bg_2-Landscape@2x.png
	- memo_bg_2-Landscape-667h@2x.png
	- shelf_new_tag~ipad.png

