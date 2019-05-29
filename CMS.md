# CMS 개발 가이드

### 방향

- 운영자가 CMS 시스템이 받쳐주지 않아 자정까지 기다리거나 주말에 회사를 나오게 만들어서는 안된다.
- 운영자도 고객. 운영상의 UX를 고민해야 한다.
- 운영도구는 끊임없이 그 효율성이 개선되어야 하며, 궁극적으로는 모든 것이 자동화되어야 한다.

### UX 가이드

**MUST**

- 반드시 최종 수정자 / 수정시간을 DB에 남기고 CMS에 노출
  - [MySQL 컬럼 규칙](https://github.com/ridi/style-guide/blob/master/MariaDB(MySQL).md#컬럼-규칙) 참고
- 숫자를 보여줄 때 콤마(,) 사용
  - 예) 35,000원 / 2,600건 등
- 테이블 내 숫자 표기 시 우측정렬



**SHOULD**

- 일시 지정 시 Datepicker 사용
- 시간에 따라 다른 콘텐츠 노출이 필요한 경우 반드시 게재시간을 입력받고 이를 기반으로 노출하도록 함
  - 예) 이벤트, 메인 상단 추천 배너, 메인 추천 도서 등
- 노출 순서의 조정이 필요한 경우 drag&drop으로 조정 가능하도록 함
  - 예) 메인 상단 추천 배너, 메인 배너 등 
- 파일 첨부가 필요한 경우 직접 올릴 수 있도록 함
  - 외부 URL을 입력받는 것이 아닌 INPUT[type:file]로 직접 올릴 수 있도록
- 성능상 큰 문제가 없을 경우 캐시는 5분 이내로
  - 너무 길면 수정 후 정상반영을 확인하기 어려워진다.
  - 캐시 시간을 CMS상에 명시하여 불필요하게 문의가 들어오는 일이 없도록 한다.
- 제약 사항이 있는 등 운영자가 혼란스러울 수 있는 부분들은 CMS상에 명시
  - 예) "서점 반영에 최대 5분이 소요됩니다.", "최대 100권까지만 노출됩니다." 등
- Radio, Checkbox 등은 Label 태그로 감싸서 텍스트를 클릭해도 선택이 되도록

```html
{% raw %}
<label class="checkbox-inline">
  <input type="checkbox" name="notice_filter_types[]" value="{{ type }}"
         {% if type not in notice.hidden_filter_publisher_type %}checked="checked"{% endif %}> {{ type }}
{% endraw %}
</label>
```

