<?php

namespace App\Models\About;

use CodeIgniter\Model;

class About extends Model
{
    protected $table            = 'about';  // Make sure this is the correct table name
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'description',
        'features',
        'image',
        'video_url',
    ];  // Allow title and description fields

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Fetch related services
    public function getServices($aboutId)
    {
        $builder = $this->db->table('services');
        $builder->where('about_id', $aboutId);
        return $builder->get()->getResultArray();
    }

    // Fetch related topics
    public function getTopics($aboutId)
    {
        $builder = $this->db->table('topics');
        $builder->where('about_id', $aboutId);
        return $builder->get()->getResultArray();
    }

    // Fetch related team members
    public function getTeam($aboutId)
    {
        $builder = $this->db->table('team');
        $builder->where('about_id', $aboutId);
        return $builder->get()->getResultArray();
    }

    // Get all about page data with related services, topics, and team
    public function getAboutPage($aboutId)
    {
        // Get about page details
        $aboutDetails = $this->find($aboutId);

        // Get related services
        $services = $this->getServices($aboutId);

        // Get related topics
        $topics = $this->getTopics($aboutId);

        // Get related team members
        $team = $this->getTeam($aboutId);

        // Combine all data into a single array
        $data = [
            'about' => $aboutDetails,
            'services' => $services,
            'topics' => $topics,
            'team' => $team,
        ];

        return $data;
    }
}
