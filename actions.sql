--update PREGUNTAS set CODAREA = (select CODAREA from AREAS where AREAS.CODCOMPETENCIA = PREGUNTAS.CODCOMPETENCIA);

--Actualizar las areas de las preguntas 
--(CUIDADO: Se debio usar la tabla COMPONENTES y no COMPETENCIAS)
update PREGUNTAS a
left join COMPETENCIAS b on
    a.CODCOMPETENCIA = b.CODCOMPETENCIA
set
    a.CODAREA = b.CODAREA
