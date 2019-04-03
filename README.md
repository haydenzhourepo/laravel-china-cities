## 中国城市区划

### feature
1. 根据中华人民共和国民政部的提供的行政区划代码 创建项目的城市表 http://www.mca.gov.cn/article/sj/xzqh/2019/
2. 提供一些封装的方法

### 使用

发布migration文件

```
artisan vendor:publish --provider="HaydenZhou\LaravelChinaCities\LaravelChinaCitiesServiceProvider"
```
```
php artisan migrate
```


创建City model

```
php artisan make:model City -c
```

City model 中 使用 CityTrait

```
namespace App;

use Illuminate\Database\Eloquent\Model;
use HaydenZhou\LaravelChinaCities\CityTrait;

class City extends Model
{
    use CityTrait;

    public $timestamps = false;

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'name', 'parent_code'];

    public function getRouteKeyName()
    {
        return 'code';
    }
    
}

```

### trait 方法
parent 父级城市

children 子城市

待完善...