# MariaDB(MySQL) 사용 규칙

## DDL(Data Definition Language) 규칙

### 테이블 규칙

- 테이블명은 소문자 snake_case 로 작성
- 도메인에 따라 (namespace)_ prefix 를 붙인다.
  - 코드에 쿼리문을 작성하는 경우 검색이 용이함.

#### 옵션

- Storage Engine
  - InnoDB(Compact) 사용 
  - 로그 테이블이 필요할 경우 TokuDB 사용 가능
  - MyISAM은 사용 금지 - 트랜잭션이 없더라도 InnoDB가 유리함
- Charset: utf8
- Collation: utf8_unicode_ci

#### 코멘트 작성
- 테이블 코멘트는 반드시 작성할 것.


### 프로시저 규칙
- sp_로 시작하며 소문자 snake_case 사용


### 컬럼 규칙

- 소문자 snake_case 를 사용
- 변경내역 추적을 위한 용도의 DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 타입 컬럼명은 "last_modified"를 사용

컬럼 자료형 규칙
- Primary Key는 항상 명시적으로 정의
  - 컬럼명은 id
  - unsigned int(10), not null, primary key, auto increment 로 설정.
    - 데이터의 폭발적 증가가 예상되면 unsigned bigint(20)을 사용하거나 MySQL 사용을 재고해 본다.
  - 일부 오래된 테이블에는 idx, pk_id라는 컬럼명을 사용하고 있는데, 이는 규칙에 어긋남.
- Foreign Key의 사용
  - index명은 fk_로 시작
  - 가급적 FK(Foreign Key)조건을 활용하여 무결성을 보장할 것.
  - 단, 사용자 데이터의 경우 샤딩을 위해 FK를 걸지 않는다.
  - rows 수의 상한을 예측하기 어렵거나 매우 많아질 가능성이 있다면 FK를 걸지 않는다.
- Boolean 컬럼은 TINYINT(1)을 사용하며, “is_” 접두어를 붙임. ('Y/N' 은 사용하지 않음)
  - Collation이 case-sensitive인 경우에 코드의 실수를 방지할 수 있음
  - enum을 정의하지 않아도 되며, 플래그로 변경이 용이
- IPv4를 저장할 때에는 UNSIGNED INT 타입을 이용
  - varchar(16)에 비해 1/4의 저장공간만 사용
- 유효기간 등을 표현할 때 이 값이 optional 한 경우 유효기간이 없음은 null로 표현
  - 유효기간이 없음을 timestamp 컬럼 값 '0000-00-00 00:00:00'으로 표현 시 ORM에서 컬럼 매칭할 때 PHP의 DateTime과 연결하는데 DateTime이 이 값을 사용할 수 없음
- 부정확한 날짜를 표기해야 할 때는, Date 타입을 사용
  `MySQL permits you to store dates where the day or month and day are zero in a DATE or DATETIME column. This is useful for applications that need to store birthdates for which you may not know the exact date. In this case, you simply store the date as '2009-00-00' or '2009-01-00'. If you store dates such as these, you should not expect to get correct results for functions such as DATE_SUB() or DATE_ADD() that require complete dates. To disallow zero month or day parts in dates, enable the NO_ZERO_IN_DATE SQL mode.
  http://dev.mysql.com/doc/refman/5.5/en/date-and-time-types.html`
  - varchar(6)을 사용할 경우 3byte(utf8) * 6 + 1byte(length) = 19byte 가 사용되나, date는 3byte만 사용.
  - zero date는 사용하지 않음(from '2015-01-00' to '2015-01-01')
    - 날짜 라이브러리마다 zero date 를 처리하는 방법이 달라서 오류가능성 높음
- 로그성 테이블
  - Join이 없고 쓰기 위주인 경우에도 MyISAM 대신 InnoDB를 사용.



## DML(Data Manipulation Language) 규칙

### NATURAL JOIN은 사용하지 않는다.
- 컬럼명을 변경하거나 새로운 컬럼을 추가할때 JOIN이 실패하거나 잘못된 결과가 발생할 수 있기 때문에,
- 항상 명시적으로 INNER JOIN을 사용.

### LOCK TABLE 구문 사용 금지
- START TRANSACTION을 했더라도 LOCK TABLE 시 이전에 수행중인 트랜잭션을 commit 하기 때문에 이후 실행된 쿼리가 롤백되지 않음
- 참고: http://dev.mysql.com/doc/refman/5.0/en/lock-tables-and-transactions.html



## 기타 참고자료

- [How to Kill MySQL Performance](http://www.slideshare.net/techdude/how-to-kill-mysql-performance)
