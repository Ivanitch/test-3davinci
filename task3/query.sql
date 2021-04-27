/* Query SQL */

SELECT brand AS Brand, COUNT(*) AS TotalItems,
(
    SELECT COUNT(*)
    FROM product_pack
    JOIN pack ON pack.id = pack_id
    AND count IS NOT NULL AND weight IS NOT NULL
    WHERE product_id = product.id
) AS FullyFilled
FROM product
WHERE name != ''
GROUP BY brand


/* ========== Result ===============

+-------+------------+-------------+
| Brand | TotalItems | FullyFilled |
+-------+------------+-------------+
| ABB   |          2 |           2 |
| SE    |          1 |           0 |
+-------+------------+-------------+

 */
