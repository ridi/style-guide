# BEM 코딩 스타일

[BEM 방법론](http://getbem.com/)을 따릅니다. 이름의 길이를 줄이기 위해 Block, Element, Modifier를 표현하는 방식을 변경해서 사용합니다.

## 스타일 가이드

### Block

PascelCase를 사용하여 표현합니다.

```html
<div class="Card">...</div>
```

### Element

언더스코어(_)와 PascelCase를 사용하여 표현합니다.

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
