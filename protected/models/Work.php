<?php

/**
 * This is the model class for table "tbl_work".
 *
 * The followings are the available columns in table 'tbl_work':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $category_id
 * @property string $requirement
 * @property string $region_id
 * @property string $phone
 * @property string $mail
 * @property string $web
 * @property string $profession_id
 * @property string $branch_id
 * @property integer $schedule
 * @property integer $experience
 * @property string $computer_experience
 * @property integer $education
 * @property integer $languages
 * @property string $salary
 * @property integer $currency
 * @property string $rating
 * @property string $period
 * @property string $views
 * @property string $likes
 * @property integer $status
 * @property string $edited_username
 * @property string $create_username
 * @property string $date_added
 * @property string $date_modified
 */
class Work extends ActiveRecord {

    public $parent_category_id, $catalog_category_id, $title, $description, $content, $name, $parent_category_code, $category_code, $file, $image, $mini_search, $category_name;
    public $state_name = 'state_work';
    public $except;
    public $salary_start;
    public $salary_end;

    private $_url;
    private $_urlupdate;
    private $_profession;
    private $_branch;


    const EDUCATION_TYPE_MEDIUM = 1, EDUCATION_TYPE_MEDIUM_SPECIAL = 2, EDUCATION_TYPE_HIGH = 3, EDUCATION_TYPE_HIGH_UNGRADUATED = 4;

    public function getEducationTypes() {
        return array(
            self::EDUCATION_TYPE_MEDIUM => Yii::t('app', 'EDUCATION_TYPE_MEDIUM'),
            self::EDUCATION_TYPE_MEDIUM_SPECIAL => Yii::t('app', 'EDUCATION_TYPE_MEDIUM_SPECIAL'),
            self::EDUCATION_TYPE_HIGH => Yii::t('app', 'EDUCATION_TYPE_HIGH'),
            self::EDUCATION_TYPE_HIGH_UNGRADUATED => Yii::t('app', 'EDUCATION_TYPE_HIGH_UNGRADUATED'),
        );
    }


    public function getEducationText() {
        $educationTypes = $this->educationTypes;
        return isset($educationTypes[$this->education]) ? $educationTypes[$this->education] : Yii::t('app', 'EDUCATION_TYPE_UNKNOWN');
    }

    const CURRENCY_MANAT = 1, CURRENCY_DOLLAR = 2;

    public static function getCurrencyOptions() {
        return array(
            self::CURRENCY_MANAT => Yii::t('app', 'CURRENCY_MANAT'),
            self::CURRENCY_DOLLAR => Yii::t('app', 'CURRENCY_DOLLAR'),
        );
    }

    public function getCurrencyText() {
        $typeOptions = $this->getCurrencyOptions();
        return isset($typeOptions[$this->currency]) ? $typeOptions[$this->currency] : Yii::t('app', '$CURRENCY_UNKNOWN');
    }


    public function getExperienceOptions() {
        $experience = array();
        for ($i = 0; $i <= 50; $i++) {
            $experience[$i] = $i;
        }
        return $experience;
    }

    public function getExperienceText() {
        $typeOptions = $this->getExperienceOptions();
        return isset($typeOptions[$this->experience]) ? $typeOptions[$this->experience] . ' ' . Yii::t('app', 'year_old') : Yii::t('app', '$EXPERIENCE_UNKNOWN');
    }


    const SCHEDULE_1 = 1, SCHEDULE_2 = 2, SCHEDULE_3 = 3, SCHEDULE_4 = 4, SCHEDULE_5 = 5, SCHEDULE_6 = 6;

    public function getScheduleOptions() {
        return array(
            self::SCHEDULE_1 => Yii::t('app', 'SCHEDULE_1'),
            self::SCHEDULE_2 => Yii::t('app', 'SCHEDULE_2'),
            self::SCHEDULE_3 => Yii::t('app', 'SCHEDULE_3'),
            self::SCHEDULE_4 => Yii::t('app', 'SCHEDULE_4'),
            self::SCHEDULE_5 => Yii::t('app', 'SCHEDULE_5'),
            self::SCHEDULE_6 => Yii::t('app', 'SCHEDULE_6'),
        );
    }

    public function getScheduleText() {
        $typeOptions = $this->getScheduleOptions();
        return isset($typeOptions[$this->schedule]) ? $typeOptions[$this->schedule] : Yii::t('app', '$SCHEDULE_UNKNOWN');
    }


    public function getUrl() {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('work/view', array('id' => $this->id));
        return strlen(trim($this->_url)) > 0 ? $this->_url : "#";
    }


//    public function getUrlupdate(){
//        if ($this->_urlupdate === null)
//            if(Yii::app()->user->checkAccess('Work.Update'))
//                $this->_urlupdate = Yii::app()->createUrl('work/update', array('id'=>$this->id));
//        return $this->_urlupdate;
//    }
//
//
    public function getUrlupdate() {
        if ($this->_urlupdate === null)
            $this->_urlupdate = Yii::app()->createUrl('item/index', array('code' => 'work', 'id' => $this->id));
        return $this->_urlupdate;
    }


    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//            'descriptions' => array(self::HAS_MANY, 'CatalogDescription', 'catalog_id'),
            'branch' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
            'profession' => array(self::BELONGS_TO, 'Professions', 'profession_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
//            'regions' => array(self::BELONGS_TO, 'Regions', 'region_id'),
            'region' => array(self::BELONGS_TO, 'Regions', 'region_id'),
            'documents' => array(self::MANY_MANY, 'Documents', 'tbl_work_to_documents(work_id,documents_id)'),
            'comment_count' => array(self::STAT, 'Comments', 'tbl_work_to_comments(work_id,comment_id)'),
        );
    }


    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_work';
    }


    public function scopes() {
        return array(
            'enabled' => array(
                'condition' => 't.status=1',
            ),

            'sort_newest' => array(
                'order' => 't.date_added desc',
            ),
            'published' => array(
                'condition' => 't.status=1 AND t.date_modified <= NOW()',
            ),
        );
    }

    public function behaviors() {
        return array_merge(parent::behaviors(), array(
                'xupload' => array(
                    'class' => 'ext.xupload.components.XUploadBehavior',
                    'state_name' => $this->state_name,
                    'related_table_name' => 'tbl_work_to_documents',
                )
            )
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id', 'required'),
            array('category_id, schedule, experience, education, currency, status', 'numerical', 'integerOnly' => true),
            array('id, region_id, profession_id, branch_id', 'length', 'max' => 20),
            array('title, requirement, phone, mail, web, computer_experience, salary, rating, edited_username, create_username', 'length', 'max' => 255),
            array('views, likes', 'length', 'max' => 10),
            array('description, period, date_added, date_modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id,salary_start,end_start, title, description, languages, category_id, requirement, region_id, phone, mail, web, profession_id, branch_id, schedule, experience, computer_experience, education, salary, currency, rating, period, views, likes, status, edited_username, create_username, date_added, date_modified', 'safe'),
            array('id, salary_start,end_start, title, description, languages, category_id, requirement, region_id, phone, mail, web, profession_id, branch_id, schedule, experience, computer_experience, education, salary, currency, rating, period, views, likes, status, edited_username, create_username, date_added, date_modified', 'safe', 'on' => 'search'),
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'id'),
            'title' => Yii::t('app', 'title'),
            'description' => Yii::t('app', 'description'),
            'category_id' => Yii::t('app', 'category_id'),
            'requirement' => Yii::t('app', 'requirement'),
            'region_id' => Yii::t('app', 'region_id'),
            'phone' => Yii::t('app', 'phone'),
            'mail' => Yii::t('app', 'mail'),
            'web' => Yii::t('app', 'web'),
            'profession_id' => Yii::t('app', 'profession_id'),
            'branch_id' => Yii::t('app', 'branch_id'),
            'schedule' => Yii::t('app', 'schedule'),
            'experience' => Yii::t('app', 'experience'),
            'computer_experience' => Yii::t('app', 'computer_experience'),
            'education' => Yii::t('app', 'education'),
            'languages' => Yii::t('app', 'languages'),
            'salary' => Yii::t('app', 'salary'),
            'currency' => Yii::t('app', 'currency'),
            'rating' => Yii::t('app', 'rating'),
            'period' => Yii::t('app', 'period'),
            'views' => Yii::t('app', 'views'),
            'likes' => Yii::t('app', 'likes'),
            'status' => Yii::t('app', 'status'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('requirement', $this->requirement, true);
        $criteria->compare('region_id', $this->region_id, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('mail', $this->mail, true);
        $criteria->compare('web', $this->web, true);
        $criteria->compare('profession_id', $this->profession_id, true);
        $criteria->compare('branch_id', $this->branch_id, true);
        $criteria->compare('schedule', $this->schedule);
        $criteria->compare('experience', $this->experience);
        $criteria->compare('computer_experience', $this->computer_experience, true);
        $criteria->compare('languages', $this->languages, true);
        $criteria->compare('education', $this->education);
        $criteria->compare('salary', $this->salary, true);
        $criteria->compare('currency', $this->currency);
        $criteria->compare('rating', $this->rating, true);
        $criteria->compare('period', $this->period, true);
        $criteria->compare('views', $this->views, true);
        $criteria->compare('likes', $this->likes, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('edited_username', $this->edited_username, true);
        $criteria->compare('create_username', $this->create_username, true);
        $criteria->compare('date_added', $this->date_added, true);
        $criteria->compare('date_modified', $this->date_modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Work the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    public function searchForCategory($limit = 50, $models = false, $beforeToday = null) {
        $criteria = new CDbCriteria;

        if ($this->category_id)
            $criteria->compare('t.category_id', $this->category_id);

        $criteria->compare('t.profession_id', $this->profession_id);
        $criteria->compare('t.education', $this->education);
        $criteria->compare('t.region_id', $this->region_id);
        $criteria->compare('t.experience', $this->experience);
        $criteria->compare('t.schedule', $this->schedule);

        if (!empty($this->salary_start) && !empty($this->salary_end)) {
            $criteria->addCondition("t.salary >= '$this->salary_start' and t.salary <= '$this->salary_end' ");
        } elseif (!empty($this->trip_start)) {
            $criteria->addCondition("t.salary >= '$this->salary_start'");
        } elseif (!empty($this->salary_end)) {
            $criteria->addCondition("t.salary <= '$this->salary_end'");
        }


        if ($this->except) {
            $criteria->addNotInCondition('t.id', $this->except);
        }


//        if (isset($this->mini_search)) {
//            $criteria->with = array("category", "category.parent", 'descriptions');
//            $criteria->together = true;
//            $criteria->compare('descriptions.title', $this->mini_search, true);
//        }

//            $criteria->select=array('id','category_id','title_'.Yii::app()->language,'content_'.Yii::app()->language);
        $criteria->scopes = array('enabled', 'sort_newest');

        if ($limit > 0) {
            $criteria->limit = $limit;
            $criteria->offset = 0;
        }

        if ($models == false) {
//               $dp= new CActiveDataProvider(self::model()->cache(Yii::app()->params['cache_duration'],new CTagCacheDependency(get_class($this)), 2),
            $dp = new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination' => ($limit > 0) ? false : array(
                        'pageSize' => Yii::app()->params['pageSize'],
                        'pageVar' => 'page',
                    ),
                ));
            return $dp;
        } else {
//                return $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->findAll($criteria);
            return $this->findAll($criteria);
        }
    }


    public function getTitle() {
        $professionName = $this->getProfession();
        if ($this->title === null || strlen(trim($this->title)) == 0) {
            $this->title = $professionName;
        }

        return $this->title . ' - ' . $professionName;
    }


    public function getProfession() {
        if ($this->_profession === null) {
            $profession = $this->profession;
            if (isset($profession)) {
                $this->_profession = $profession->name;
            }
        }
        return $this->_profession;
    }

    public function getBranch() {
        if ($this->_branch === null) {
            $branch = $this->branch;
            if (isset($branch)) {
                $this->_branch = $branch->name;
            }
        }
        return $this->_branch;
    }


    public function getDescription() {
        $attribute = 'description';
        return $this->{$attribute};
    }


    protected function beforeDelete()
    {
        echo "</br> Before delete: ";
        $documents = $this->documents;
        if (isset($documents)) {
            foreach ($documents as $doc) {
                echo "</br> fullDelete for document id:" . $doc->id;
                $doc->fullDelete('tbl_work_to_documents');
            }
        }
        return parent::beforeDelete();
    }
}
