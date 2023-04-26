<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Apply
 *
 * @property int $id
 * @property string $fullname
 * @property string $phone
 * @property string $email
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $birthday
 * @property string|null $attachment
 * @property string|null $status
 * @property string|null $candidate_note
 * @property int|null $user_id
 * @property int|null $post_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Apply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Apply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Apply query()
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereCandidateNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apply whereUserId($value)
 */
	class Apply extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $message
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $post_title
 * @property string|null $post_content
 * @property string $post_date
 * @property string $post_date_update
 * @property int $post_view
 * @property string $post_status
 * @property string $post_type
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostDateUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostFavorite
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $post_id
 * @property int $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostFavorite whereUserId($value)
 */
	class PostFavorite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostMeta
 *
 * @property int $id
 * @property int|null $post_id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostMeta whereValue($value)
 */
	class PostMeta extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostTag
 *
 * @property int $id
 * @property int|null $post_id
 * @property int|null $tag_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Database\Factories\PostTagFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereUpdatedAt($value)
 */
	class PostTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Recruiter
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $image
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $description
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruiter whereUserId($value)
 */
	class Recruiter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $tag_category
 * @property string $tag_key
 * @property string $tag_name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTagCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTagKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $gender
 * @property string|null $birthday
 * @property string|null $avatar
 * @property string $email
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Message> $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

