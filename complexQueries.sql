--companies with the greatest number of cryptography interns
SELECT foo.company, foo.count
        from (select i.company, count(*)
                from internship i, student s, team t, works_on w, project p
                where i.ssn = s.ssn and s.teamid = t.id and t.id = w.teamid and w.ptitle = p.pname and p.domain = 'Cryptography'
                group by i.company) foo
        where foo.count = (select max(bar.count)
                            from (select i.company, count(*)
                                    from internship i, student s, team t, works_on w, project p
                                    where i.ssn = s.ssn and s.teamid = t.id and t.id = w.teamid and w.ptitle = p.pname and p.domain = 'Cryptography'
                                group by i.company) bar
                            );

--project domain with the maximum number of minor projects
SELECT t1.domain,
            t1.count
            from (select domain,count(*)
                        from project
                        where ptype = 'Minor'
                        group by domain )t1
            where t1.count = (select max(t2.count)
                            from (select domain,count(*)
                                    from project
                                    where ptype = 'Minor'
                                    group by domain) t2
                            );


--guide of the team with greatest average gpa
SELECT tc.tname
            from teacher tc,works_on w,(select teamid, avg(CGPA)
                        from student
                        group by teamid) bar
            where tc.tid = w.teacherid and w.teamid = bar.teamid and bar.avg = (select max(t1.avg)
                                                                                from (select s.teamid, avg(CGPA)
                                                                                        from student s
                                                                                        group by s.teamid)t1
                                                                                      );

--teachers who are a part of more than 2 panels
SELECT distinct tname
            from teacher
            where tid in
            (SELECT teacherid
            from part_of
            group by teacherid
            having count(*) > 2
  );

-- teachers who are not guides but are part of panels
SELECT distinct teacherid, tname from teacher tc, part_of p,
    (select t.tid from teacher t where not exists
      ( select * from works_on where teacherid = t.tid ))foo
        where foo.tid = teacherid and tc.tid = teacherid ;
