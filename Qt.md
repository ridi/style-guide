# Qt 코딩 스타일

## C++ 코딩 스타일

기본적으로 Google C++ Style Guide를 따른다. 이 외에 차이점이나 추가 사항은 아래와 같다.

### Naming
- File Names: 공백 대신 ”-” 사용. 확장자는 아래와 같이
  - 헤더 파일: .h
  - 소스 파일: .cpp

### Formatting
- Spaces vs. Tabs: Use only spaces, and indent 4 spaces at a time
- Braces: brace 내 코드가 한줄이더라도 brace로 반드시 감싸는 것으로 한다.

```cpp
if (condition) {
    doSomething();
}
```


## XML 코딩 스타일

### Naming
- File Names: 공백 대신 ”-” 사용. 확장자는 아래와 같이
- ui 파일: .ui

### Formatting
- Spaces vs. Tabs: Use only spaces, and indent 2 spaces at a time


## 참고
- [Google C++ Style Guide](https://google.github.io/styleguide/cppguide.html)
