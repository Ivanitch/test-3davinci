<?php

declare(strict_types=1);

namespace App;

use Exception;

class Category
{
    /**
     * @var DB
     */
    protected DB $connection;

    protected string $table = 'category';

    /**
     * Category constructor.
     * @param DB $connection
     */
    public function __construct(DB $connection)
    {
        $this->setConnection($connection);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getCategories(): array
    {
        $query = "SELECT * FROM " . $this->getTable();

        return $this->getConnection()->getRows($query);
    }

    /**
     * @param $data
     * @return array
     */
    public function createTree($data): array
    {
        $subs = [];

        foreach ($data as $key => $item):
            $subid = $item['subid'] ?? 0;
            $subs[$subid][$item['id']] = $item;
        endforeach;
        $treeElement = $subs[0];
        $this->generateElemTree($treeElement, $subs);

        return $treeElement;
    }

    /**
     * @param $data
     */
    public function renderTemplate($data)
    {
        echo "<ul>";

        if(is_array($data)):
            foreach ($data as $item):
                echo '<li>' . $item['name'];
                if(count($item['sub']) > 0):
                    $this->renderTemplate($item['sub']);
                endif;
                echo '</li>';
            endforeach;
        endif;

        echo "</ul>";
    }


    /**
     * @param $treeElement
     * @param $subs
     */
    protected function generateElemTree(&$treeElement, $subs)
    {
        foreach ($treeElement as $key => $item):

            if (!isset($item['sub'])):
                $treeElement[$key]['sub'] = [];
            endif;

            if (array_key_exists($key, $subs)):
                $treeElement[$key]['sub'] = $subs[$key];
                $this->generateElemTree($treeElement[$key]['sub'], $subs);
            endif;

        endforeach;
    }

    /**
     * @return string
     */
    protected function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param DB $connection
     */
    protected function setConnection(DB $connection): void
    {
        $this->connection = $connection;
    }

    /**
     * @return DB
     */
    protected function getConnection(): DB
    {
        return $this->connection;
    }
}
