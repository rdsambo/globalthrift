SELECT t.date,
       t.amount,
       if(t.PTYPE = "DEPOSITE", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum
FROM
( SELECT *
  FROM customer_transactions  ) t
JOIN (SELECT @running_total:=0) r
where t.AccountId = 365
ORDER BY t.date


SELECT X.*
  FROM ( SELECT 
                AccountId,
                 'WITHDRAWAL' AS PTYPE,
                 WAmt as amount,
                 WDate as date
            FROM ddwithdrawal
           WHERE AccountId = 365  
          UNION
          SELECT AccountId,
                 'DEPOSITE' AS PTYPE,
                 DAmt as amount,
                 ColDate as date
            FROM `ddcollection`
           WHERE AccountId = 365
        ) X
 ORDER BY X.`date`


 SELECT 
t.AccountId,
t.date,
t.PTYPE,
       t.amount,
       if(t.PTYPE = "DEPOSIT", @running_total:=@running_total + t.amount, @running_total:=@running_total - t.amount) AS cumulative_sum
FROM
( SELECT X.*
  FROM ( SELECT 
                AccountId,
                 'WITHDRAWAL' AS PTYPE,
                 WAmt as amount,
                 WDate as date
            FROM ddwithdrawal
          UNION
          SELECT AccountId,
                 'DEPOSIT' AS PTYPE,
                 DAmt as amount,
                 ColDate as date
            FROM `ddcollection`
        ) x)
        
         t
JOIN (SELECT @running_total:=0) r
where t.AccountId = 365
ORDER BY t.date