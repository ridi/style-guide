# MariaDB(MySQL) 사용 규칙

AWS RDS에서 MariaDB 슬레이브를 구축할 경우 10.1 버전 권장[\*]

[\*]: https://mydbops.wordpress.com/2018/01/18/replication-will-not-start-on-rds-mariadb-10-2/


## DDL(Data Definition Language) 규칙

### 테이블 규칙

- 테이블명은 소문자 snake_case 로 작성
- 테이블명은 단수(singular)형을 사용

#### 옵션

- Storage Engine
- InnoDB(Compact) 사용
- MyISAM 사용 금지 (트랜잭션이 없더라도 InnoDB가 유리함)
- TokuDB 사용은 로그성 테이블에만 한정
- Charset: `utf8mb4`
- Collation: `utf8mb4_unicode_ci`

#### 코멘트 작성
- 테이블 코멘트는 반드시 작성




### 프로시저 규칙
- sp_로 시작하며 소문자 snake_case 사용




### 뷰 규칙
- v_로 시작하며 소문자 snake_case 사용




### 컬럼 규칙

- 소문자 snake_case 를 사용
- 변경내역 추적을 위한 컬럼의 타입은 `DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP` 사용

#### 컬럼 자료형 규칙

- Primary Key는 항상 명시적으로 정의
  - 컬럼명은 id
    - 일부 오래된 테이블에는 idx, pk_id라는 컬럼명을 사용하고 있는데, 이는 규칙에 어긋남
  - `INT(10) UNSIGNED` 혹은 `BIGINT(20) UNSIGNED`을 사용
  - 반드시 primary key, auto increment 속성을 지정

- Index의 사용

  - index명은 idx_로 시작 (선택사항)
  - 커버링 인덱스의 경우 c_idx_로 시작 (선택사항)
  - 역순 정렬이 필요한 경우 명시적으로 rev_컬럼을 추가하고 인덱스에 포함
    - 하위호환을 위해 컬럼에 `PERSISTENT` 속성은 지정하지 않음

- Foreign Key의 사용
  - index명은 fk_로 시작 (선택사항)
  - 가급적 FK(Foreign Key)조건을 활용하여 무결성을 보장할 것
  - 단, 사용자 데이터의 경우 샤딩을 위해 FK를 걸지 않음
  - rows 수의 상한을 예측하기 어렵거나 매우 많아질 가능성이 있다면 FK를 걸지 않음

- Boolean 컬럼은 `TINYINT(1)`을 사용하며, “is_” 접두어를 붙임. ('Y/N' 은 사용하지 않음)
  - Collation이 case-sensitive인 경우에 코드의 실수를 방지할 수 있음
  - enum을 정의하지 않아도 되며, 플래그로 변경이 용이

- IPv4를 저장할 때에는 `UNSIGNED INT` 타입을 이용
  - `VARCHAR(16)`에 비해 1/4의 저장공간만 사용

- 유효기간 등을 표현할 때 이 값이 optional 한 경우 유효기간이 없음은 null로 표현

- 시간대는 `Asia/Seoul`만 사용

  - 데이터베이스에는 KST(+0900)로 보관하고, 새롭게 생성하게 되는 컬럼에도 UTC는 사용하지 않는다.
  - 이는 UTC와 KST를 혼용할 때 발생하는 실수를 최소화하기 위한 결정이다.

- `TIMESTAMP` 타입은 사용하지 않는다.

  - 기존 데이터는 2038년이 도래하기 전까지 변환을 완료할 것

- 부정확한 날짜를 표기해야 할 때는, `DATE` 타입을 사용

  - 참고: http://dev.mysql.com/doc/refman/5.5/en/date-and-time-types.html

    `MySQL permits you to store dates where the day or month and day are zero in a DATE or DATETIME column. This is useful for applications that need to store birthdates for which you may not know the exact date. In this case, you simply store the date as '2009-00-00' or '2009-01-00'. If you store dates such as these, you should not expect to get correct results for functions such as DATE_SUB() or DATE_ADD() that require complete dates. To disallow zero month or day parts in dates, enable the NO_ZERO_IN_DATE SQL mode.`
  - `VARCHAR(6)`을 사용할 경우 4byte(utf8mb4) * 6 + 1byte(length) = 25byte 가 사용되나, `DATE`는 4byte만 사용.
  - zero date는 사용하지 않음(from '2015-01-00' to '2015-01-01')
    - 날짜 라이브러리마다 zero date 를 처리하는 방법이 달라서 오류가능성 높음




---



## DML(Data Manipulation Language) 규칙

#### NATURAL JOIN은 사용하지 않는다.
컬럼명을 변경하거나 새로운 컬럼을 추가할때 JOIN이 실패하거나 잘못된 결과가 발생할 수 있기 때문에, 항상 명시적으로 INNER JOIN을 사용

#### LOCK TABLE 구문 사용 금지
START TRANSACTION을 했더라도 LOCK TABLE 시 이전에 수행중인 트랜잭션을 commit 하기 때문에 이후 실행된 쿼리가 롤백되지 않음

참고: http://dev.mysql.com/doc/refman/5.0/en/lock-tables-and-transactions.html
