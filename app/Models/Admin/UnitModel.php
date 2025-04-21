<!-- 
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    use HasFactory;
    protected $table = "tbl_unit";
    protected $primaryKey = 'unit_id';
    protected $fillable = [
        'unit_nama',
        'unit_slug',
        'unit_alamat',
        'unit_notelp',
    ]; 
} -->
