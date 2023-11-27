type Validation = true | string

export default
{
    required(val: string | unknown[]): Validation
    {
        return (val !== null && val !== undefined && val.length != 0) || 'Required field'
    },

    minLength(length: number): (v: string | unknown[]) => Validation
    {
        return val =>
        {
            const unit = typeof val == 'string'
                ? 'character'
                : 'element'
            return val.length >= length || `The field requires at least ${length} ${unit}s`
        }
    },

    maxLength(length: number): (v: string | unknown[]) => Validation
    {
        return val =>
        {
            const unit = typeof val == 'string'
                ? 'character'
                : 'element'
            return val.length <= length || `The field requires a maximum of ${length} ${unit}s`
        }
    }
}
