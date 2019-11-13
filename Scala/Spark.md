# Spark 개발 가이드

Spark Application 개발은 scala 사용을 원칙으로 한다.

## Scala Style Guides
스칼라 코딩 스타일은 [Scala 코딩 스타일 가이드](../Scala)를 참조한다.

## Naming
### Variables
- 기본적으로 변수명은 `camelCase`를 사용한다.
  - 다음의 케이스는 예외적으로 `snake_case`를 사용한다.
    - `DataFrame/Dataset`을 `case class`에 담아 테이블로 저장하는 경우
      - 필드명이 테이블 컬럼이름으로 사용되기 때문에 `case class`의 필드명은 `snake_case`를 사용한다.
    - 비슷한 맥락으로, `Column.name`도 SQL코드를 쉽게 작성할 수 있도록 `snake_case`로 작성한다. 
- `DataFrame/Dataset/RDD`를 담는 변수명에는 `DF/DS/RDD` postfix를 붙인다.
    ```scala
    val userDF: DataFrame = ...
    val bookDS: Dataset[Book] = ...
    val bestsellerRDD: RDD[Bestseller] = ...
    ```
- 하나의 객체를 나타내는 변수명에는 단수형을, 복합 객체를 표현하는 변수명에는 복수형을 사용하되 의미상 중복을 최소화한다.
    ```scala
    val defaultCategory = "comic"
    val categories = List("general", "romance", "fantasy", "comic", "bl")
  
    // Don't do this
    val categoryList = List("general", "romance", "fantasy", "comic", "bl")
    ```

### Application
- Spark Application의 이름은 동사구(verb phrase)를 사용한다. `ex) BuildBestseller, BuildRecommend`

## Chained Method Invocations
- chained method 호출은 다음의 경우를 모두 허용한다.
  - on a single line
    - line length가 100 이내이고 가독성을 헤치지 않는 경우 허용
  - on multiple lines
    - 일반적인 모든 경우
    - argument를 받는 method가 한 line에 둘 이상 올 수 없음
```scala

outputDF.write.format("parquet").mode(SaveMode.Overwrite).saveAsTable(output)

outputDF.write
  .format("parquet")
  .mode(SaveMode.Overwrite)
  .saveAsTable(output)

outputDF.write.format("parquet")
  .mode(SaveMode.Overwrite)
  .saveAsTable(output)

// don't do these
outputDF.write.format("parquet").mode(SaveMode.Overwrite)
  .saveAsTable(output)

outputDF.write
  .format("parquet").mode(SaveMode.Overwrite)
  .saveAsTable(output)
```

## Spark SQL
- 쿼리문이 간결하고 짧은 경우 singleline string 사용
```scala
val teenagerNameDS = spark.sql("SELECT name FROM people WHERE age BETWEEN 13 AND 19").as[Name]
```
- 그렇지 않은 경우 indent와 함께 multiline string 사용, 쿼리문 내 indent는 `1 space` 사용
```scala
val teenagerNameDS = spark
  .sql(
    s"""
    |SELECT
    | name // indent 1 space
    |FROM people
    |WHERE age BETWEEN 13 AND 19
    |""".stringMargin
  ).as[Name]
```

## RDD vs Spark SQL, Dataset, DataFrame API
- 가급적이면 Spark SQL, Dataset & DataFrame API를 사용한다.
  - Type Safety, High Level Abstraction
  - Spark SQL의 Catalyst Optimizer로 인한 성능 최적화 
- Low Level의 세밀한 제어가 필요한 경우 RDD API 사용을 허용한다.

## 참고문서
- [Spark Examples](https://github.com/apache/spark/tree/master/examples/src/main/scala/org/apache/spark/examples)
- [MrPowers/spark-style-guide](https://github.com/MrPowers/spark-style-guide)
- [A Tale of Three Apache Spark APIs: RDDs vs DataFrames and Datasets - When to use them and why](https://databricks.com/blog/2016/07/14/a-tale-of-three-apache-spark-apis-rdds-dataframes-and-datasets.html)
- [Deep Dive into Spark SQL’s Catalyst Optimizer](https://databricks.com/blog/2015/04/13/deep-dive-into-spark-sqls-catalyst-optimizer.html)
