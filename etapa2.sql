select d.dept_name as `Nome do Departamento`, 
concat(e.first_name,' ',e.last_name) as `Nome Completo do Funcionário`, 
(CASE WHEN DATEDIFF(to_date, de.from_date) IS NULL THEN DATEDIFF(NOW(),de.from_date) ELSE DATEDIFF(to_date, de.from_date) END) as `Dias Trabalhados no departamento` from employees e inner join dept_emp de on
e.emp_no = de.emp_no
inner join departments d on de.dept_no=d.dept_no order by `Dias Trabalhados no departamento` desc limit 10