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

- Line length는 100으로 한다.

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
