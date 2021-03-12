折旧规则提供了一个约束物资贬值的规范，你可以在这里制定不同分类甚至是细化到单个物资本身的折旧规则。

### 新增

左侧导航栏点击 `折旧规则`，在表格右上角点击 `新增`，弹出的对话框中输入以下信息：

- 名称：必填项，为规则起一个别名来记得更简单。

- 描述：可选项，用于描述、备注作用。

- 规则：必填项，在这里可以填写无限多的规则，可以填写的字段有 `年份` `比率`，`年份` 为 1 表示至今已经离当初的购入时间超过了一年，使用 `比率` 进行换算，`比率` 的范围从 0 至 1 之间，例如一个规则为 `年份：2`
  和 `比率：0.6` 的意思为至今已经离物资当初购入的时间已经超过2年的话，就以最初购入价格的 `0.6` 折旧，价值也等于这个物资的 `价格 * 0.6`
  。可能你注意到了，如果有两条甚至两条以上的规则会怎么处理，放心，我们已经为你做好了自动的转换，当存在多条规则的时候，咖啡壶会自动选择最接近的条件来计算折旧，例如规则 `年份:1，比率0.8` 和规则 `年份:2，比率0.6`
  以及规则`年份5，比率0.3` 三条被定义了，而实际上某物资至今已经离当初的购入时间为3年，那么咖啡壶会自动使用规则 `年份2，比率0.6` 来计算，即便这个物资也符合规则 `年份:1，比率0.8`
  ，但很明显这个物资应该是属于前者的规则，因此多条规则并不会产生冲突，反而更方便的定义梯度折旧规则。

### 显示

在 `折旧规则列表` 表格中，在任意一条记录右侧，点击 `显示`，会跳转到所选择折旧规则记录的详情页。

### 编辑

在 `折旧规则列表` 表格中，在任意一条记录右侧，点击 `编辑`，会跳转到所选择折旧规则记录的编辑页，编辑页内的项目填写规则与新增准则一致。

### 删除

在 `折旧规则列表` 表格中，在任意一条记录右侧，点击 `删除`，即可删除此条折旧规则记录。

PS：折旧规则制定好之后，就可以在物资对应的分类或者记录中来使用它，具体可参考对应的物资使用文档说明。