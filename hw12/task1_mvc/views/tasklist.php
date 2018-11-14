<header>
  <br>
  <div>
    <span><?php echo $_SESSION['user']['login'] ?></span>
    (<a href="index.php?user=signout">выйти</a>)
  </div>
  <hr>
</header>
<form action="index.php" method="post">
  <fieldset>
    <legend>Новая задача</legend>
    <label>
      Описание задачи: <br>
      <textarea name="desc" cols="30" rows="5"><?php echo $desc ?></textarea>
    </label>
    <label>
      Кому назначить:
      <select name="user">
        <option value="">Не выбран</option>
        <?php foreach ($users as $user): ?>
          <option value="<?php echo $user['id'] ?>">
            <?php echo $user['login'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <br>
    <button name="add">Сохранить</button>
  </fieldset>
</form>
<p><?php echo $msg ?></p>
<hr>
<main>
  <h3>Список задач</h3>
  <?php if (count($tasks) > 0): ?>
    <table>
      <thead>
      <tr>
        <th>Дата добавления</th>
        <th>Описание</th>
        <th>Выполнение</th>
        <th>Исполнитель</th>
        <th>Делегировать</th>
        <th>Действия</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($tasks as $task): ?>
        <tr>
          <?php foreach ($task as $key => $value): ?>
            <?php if ($key === 'id') continue; ?>
            <td>
              <?php
              if ($key === 'date_added') {
                echo date('d.m.Y H:i', strtotime($value));
              } elseif ($key === 'is_done') {
                $str = $value === '0' ? 'Выполнить' : 'Невыполнено';
                $taskId = $task['id'];
                echo "<a href='tasks.php?toggleDone=$taskId'>$str</a>";
              } else {
                echo $value;
              }
              ?>
            </td>
          <?php endforeach; ?>
          <td>
            <form action="tasks.php" method="post">
              <input type="hidden" name="taskId" value="<?php echo $taskId ?>">
              <select name="assignedUserId">
                <?php foreach ($users as $user): ?>
                  <option value="<?php echo $user['id'] ?>">
                    <?php echo $user['login'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <button>Изменить</button>
            </form>
          </td>
          <td>
            <a href="tasks.php?delete=<?php echo $taskId ?>">Удалить</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Пока нет задач</p>
  <?php endif; ?>
</main>

