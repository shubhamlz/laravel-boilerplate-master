<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\Order;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class TeamService.
 */
class OrderService extends BaseService
{
    /**
     * TeamService constructor.
     *
     * @param  Order  $order
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * @param  array  $data
     * @return Order
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Order
    {

        DB::beginTransaction();
        $image = $data['image'];
        $imagename = time() . '.' . $image->getClientoriginalExtension();

        $path = Storage::disk('public')->putFileAs('images', $image, $imagename);
        try {
            $team = $this->createTeam([
                'img' => $imagename,
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'available_from' => isset($data['available_from']) && $data['available_from'] != "" ? $data['available_from'] : now(),
                'designation' => $data['designation'],
                'available_till' => date('Y-m-d H:i:s', strtotime($data['available_from'] . ' + 2 hours')),
            ]);
            // dd($team);
            // TODO: Handle team roles and permissions here

        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating this team. Please try again.'));
        }

        DB::commit();

        return $team;
    }

    /**
     * @param  Team  $team
     * @param  array  $data
     * @return Team
     *
     * @throws \Throwable
     */
    public function update(Team $team, array $data = [], $tdata): Team
    {
        $old_image = $tdata->get('old_image');
        DB::beginTransaction();
        $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : $old_image;
        if (isset($data['image']) && !empty($data['image'])) {
            if (!empty($old_image)) {
                if (Storage::disk('public')->exists('images/' . $old_image)) {
                    Storage::disk('public')->delete('images/' . $old_image);
                }
            }
            $imagename = time() . '.' . $image->getClientoriginalExtension();
            $path = Storage::disk('public')->putFileAs('images', $image, $imagename);
        } else {
            $imagename = $image;

            // echo $image;die();
        }

        try {
            $teamData = [
                'img' => $imagename,
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'available_from' => isset($data['available_from']) && $data['available_from'] != "" ? $data['available_from'] : now(),
                'designation' => $data['designation'],
                'available_till' => date('Y-m-d H:i:s', strtotime($data['available_from'] . ' + 2 hours')),
            ];

            // Update the team
            
            $this->updateTeam($teamData, $tdata->get('id'));
            // TODO: Handle team roles and permissions here
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this team. Please try again.'));
        }



        return $team;
    }

    /**
     * @param  array  $data
     * @return Team
     */
    /**
     * @param  array  $data
     * @return Team
     */
    /**
     * @param  array  $data
     * @return Team
     */
    protected function updateTeam(array $data = [], $id): Team
    {   
        $team = $this->model->where('id', $id)->firstOrFail();
        $team->update([
            'img' => $data['img'],
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'available_from' => isset($data['available_from']) && $data['available_from'] != "" ? $data['available_from'] : now(),
            'designation' => $data['designation'],
            'available_till' => date('Y-m-d H:i:s', strtotime($data['available_from'] . ' + 2 hours')),
        ]);

        return $team;
    }


    protected function createTeam(array $data = []): Team
    {
        return $this->model::create([
            'name' => $data['name'],
            'img' => $data['img'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'available_from' => isset($data['available_from']) && $data['available_from'] != "" ? $data['available_from'] : now(),
            'designation' => $data['designation'],
            'available_till' => date('Y-m-d H:i:s', strtotime($data['available_from'] . ' + 2 hours')),
        ]);
    }
}
