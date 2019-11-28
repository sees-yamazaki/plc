INSERT INTO test_i01 (`i01name`,`i01name2`,`i01qty`,`i01price`,`i01gyosha1`,`i01gyosha2`,`i01gyosha3`,`i01gyosha4`,`i01gyosha5`) SELECT DISTINCT D.d01tokusan_hinmei,'',0,0,0,0,0,0,0 FROM (SELECT * FROM test_d01 WHERE d01tokusan_hinmei <>'' and d01tokusan_hinmei IS NOT NULL) D  ORDER BY D.d01tokusan_hinmei;

