<?php

namespace App\Services;

use App\Models\Queue;
use Illuminate\Support\Facades\Log;

class QueueService
{
    /**
     * Get all queue entries
     */
    public function getAllQueues()
    {
        return Queue::orderBy('created_at', 'desc')->get();
    }

    /**
     * Create a new queue entry
     */
    public function createQueue(array $data)
    {
        Log::info('Data for queue creation:', $data);
        return Queue::create([
            'customer_name' => $data['customer_name'],
            'service_type' => $data['service_type'],
            'status' => 'waiting',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Update queue status
     */
    public function updateQueueStatus($queueId, $status)
    {
        $queue = Queue::findOrFail($queueId);
        $queue->status = $status;
        $queue->save();
        return $queue;
    }

    /**
     * Get active queues (waiting and in-progress)
     */
    public function getActiveQueues()
    {
        return Queue::whereIn('status', ['waiting', 'in_progress'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Get queue by ID
     */
    public function getQueueById($queueId)
    {
        return Queue::findOrFail($queueId);
    }

    /**
     * Delete queue entry
     */
    public function deleteQueue($queueId)
    {
        $queue = Queue::findOrFail($queueId);
        return $queue->delete();
    }
}
