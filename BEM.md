# BEM 코딩 스타일

## 도입 배경
각기 다른 방법으로 스타일시트가 작성되어왔습니다. 스타일시트 일관성 유지를 위해 CSS 방법론 도입을 고려하였고, 그 중 BEM을 선택했습니다. 그 이유는 상대적으로 러닝 커브가 적어 빠르게 도입할 수 있고, 컴포넌트 단위의 개발과 잘 어울려 많은 수의 컴포넌트를 개발하고 있는 팀 상황에 적합했기 때문입니다.
 
## 스타일 가이드
[BEM 방법론](http://getbem.com/)을 따릅니다. 클래스 이름의 길이를 줄이기 위해 Block, Element, Modifier를 표현하는 방식을 간략하게 변경해서 사용합니다.

### Block

PascalCase를 사용하여 표현합니다.

```html
<div class="Card">...</div>
```

### Element

언더스코어(_)와 PascalCase를 사용하여 표현합니다.

```html
<div class="Card">
  <h2 class="Card_Title>...</h2>
</div>
```

### Modifier

대시(-)와 camelCase를 사용하여 표현합니다.

```html
<div class="Card Card-disabled">
  <h2 class="Card_Title>...</h2>
</div>
```
