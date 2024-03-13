SELECT
    d.department_id,
    d.department_name,
    AVG(es.salary) AS avg_salary
FROM
    departments d
        LEFT JOIN
    employees e ON d.department_id = e.department_id
        LEFT JOIN
    employee_salaries es ON e.employee_id = es.employee_id
GROUP BY
    d.department_id, d.department_name;
