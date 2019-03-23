\c register

select teamid from student where Ssn='PES1201700119';

select w.teacherid from works_on w,team t,student s where s.teamid = t.id and t.id=w.teamid and s.ssn='PES1201700119'; 

select teacher.Tname from works_on w,team t,student s, teacher where s.teamid = t.id and t.id=w.teamid and s.ssn='PES1201700119' and w.teacherid =teacher.TID; 

select teacher.Tname from works_on w,team t,student s, teacher where s.teamid = t.id and t.id=w.teamid and s.ssn='PES1201700119' and w.teacherid =teacher.TID; 

select s.* from works_on w, teacher t, student s where w.teacherid = t.tid and t.tname = 'Kaylynn P.' and s.teamid = w.teamid;

select domain from works_on w,team t,student s,project where s.teamid = t.id and t.id=w.teamid and pname = w.ptitle and s.ssn='PES1201700119'; 

select s.fname,s.ssn from works_on w,team t,student s,project where s.teamid = t.id and t.id=w.teamid and pname = w.ptitle and domain='ML';

select count(w.teamid) from works_on w, project p where p.domain='DIP' and p.pname = w.ptitle;

select panelid from part_of p, teacher t where p.teacherid = t.tid and t.tname = 'Kaylynn P.';

select count(panelid) from part_of p, teacher t where p.teacherid = t.tid and t.tname = 'Rylie N.';

select t.tname from teacher t, part_of p, student s, works_on w, team te where s.fname = 'Fiona' and s.minit = 'Z.' and s.lname = 'W.' and s.teamid = te.id and w.teamid = te.id and te.panelid = p.panelid and p.teacherid = t.tid;

select p.domain from project p, works_on w, teacher t where t.tname = 'Rylie N.' and t.tid = w.teacherid and w.ptitle = p.pname;

select p.domain from works_on w,teacher t,project p where t.tid=w.teacherid and pname = w.ptitle and t.tname='Valentina T.' ;

select (p.pname, t.tname, te.id) from team te, teacher t, project p, works_on w where p.domain ='ML' and p.pname = w.ptitle and te.id = w.teamid and t.tid = w.teacherid;



